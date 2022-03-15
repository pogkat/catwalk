<?php

namespace Frontastic\Catwalk\ApiCoreBundle\Domain\Hooks;

use Frontastic\Common\CoreBundle\Domain\Json\InvalidJsonDecodeException;
use Frontastic\Common\CoreBundle\Domain\Json\InvalidJsonEncodeException;
use Frontastic\Common\HttpClient;
use Frontastic\Catwalk\ApiCoreBundle\Domain\ContextService;
use Frontastic\Catwalk\FrontendBundle\EventListener\RequestIdListener;
use GuzzleHttp\Promise\Create;
use GuzzleHttp\Promise\PromiseInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Frontastic\Common\CoreBundle\Domain\Json\Json;
use Frontastic\Common\HttpClient\Response;

class ExtensionService
{
    const DEFAULT_HEADERS = ['Content-Type: application/json'];
    const BASE_PATH = 'http://localhost:8082/'; // TODO: move to a config file later on
    const DYNAMIC_PAGE_EXTENSION_NAME = 'dynamic-page-handler';

    private ContextService $contextService;

    /** @var array[] */
    private ?array $extensions = null;

    private RequestStack $requestStack;

    private HttpClient $httpClient;


    public function __construct(
        ContextService $contextService,
        RequestStack $requestStack,
        HttpClient $httpClient
    ) {
        $this->contextService = $contextService;
        $this->requestStack = $requestStack;
        $this->httpClient = $httpClient;
    }

    /**
     * Fetches the extension list from the extension runner
     *
     * @param string $project
     * @return array
     * @throws InvalidJsonDecodeException
     * @throws \Exception
     */
    public function fetchProjectExtensions(string $project): array
    {
        //TODO: should the path be changed to 'extensions' in the extension runner?
        $response = $this->httpClient->get($this->makePath('hooks', $project));

        if ($response->status != 200) {
            throw new \Exception(
                'Fetching available extensions failed. Error: ' . $response->body
            );
        }

        return Json::decode($response->body, true);
    }

    /**
     * Gets the list of extensions
     *
     * If the list does not exist yet, it will be fetched automatically from the extension runner
     *
     * @return array|array[]
     * @throws InvalidJsonDecodeException
     */
    public function getExtensions(): array
    {
        if ($this->extensions === null) {
            $this->extensions = $this->fetchProjectExtensions($this->getProjectIdentifier());
        }

        return $this->extensions;
    }

    /**
     * Check if extension exists
     *
     * @param string $extensionName
     * @return bool
     * @throws InvalidJsonDecodeException
     */
    public function hasExtension(string $extensionName): bool
    {
        $hooks = $this->getExtensions();

        return in_array($extensionName, array_keys($hooks), true);
    }

    /**
     * Checks if the dynamic page handler extension exists
     *
     * @return bool
     * @throws InvalidJsonDecodeException
     */
    public function hasDynamicPageHandler(): bool
    {
        return $this->hasExtension(self::DYNAMIC_PAGE_EXTENSION_NAME);
    }

    /**
     * Check if the specified action extension exists
     *
     * @param $namespace
     * @param $action
     * @return bool
     * @throws InvalidJsonDecodeException
     */
    public function hasAction($namespace, $action): bool
    {
        $hookName = $this->getActionHookName($namespace, $action);
        return $this->hasExtension($hookName);
    }

    /**
     * Calls a datasource extension
     *
     * @param string $extensionName
     * @param array $arguments
     * @return PromiseInterface
     * @throws InvalidJsonEncodeException|InvalidJsonDecodeException
     */
    public function callDataSource(string $extensionName, array $arguments): PromiseInterface
    {
        return $this->callExtension($extensionName, $arguments);
    }

    /**
     * Calls a dynamic page handler extension
     *
     * @param array $arguments
     * @return object
     * @throws InvalidJsonEncodeException|InvalidJsonDecodeException
     */
    public function callDynamicPageHandler(array $arguments): object
    {
        return Json::decode($this->callExtension(self::DYNAMIC_PAGE_EXTENSION_NAME, $arguments)->wait());
    }

    /**
     * Calls an action
     *
     * @param string $namespace
     * @param string $action
     * @param array $arguments
     * @return mixed|object
     * @throws InvalidJsonDecodeException|InvalidJsonEncodeException
     */
    public function callAction(string $namespace, string $action, array $arguments)
    {
        $hookName = $this->getActionHookName($namespace, $action);
        return Json::decode($this->callExtension($hookName, $arguments)->wait());
    }

    private function getActionHookName(string $namespace, string $action): string
    {
        return sprintf('action-%s-%s', $namespace, $action);
    }

    private function getProjectIdentifier(): string
    {
        $context = $this->contextService->createContextFromRequest();
        return $context->project->customer . '_' . $context->project->projectId;
    }


    /**
     * @throws InvalidJsonEncodeException
     * @throws InvalidJsonDecodeException
     */
    private function callExtension(string $extensionName, array $arguments): PromiseInterface
    {
        if (!$this->hasExtension($extensionName)) {
            return Create::promiseFor(Json::encode([
                'ok' => false,
                'message' => sprintf('The requested extension "%s" was not found.', $extensionName)
            ]));
        }

        $requestId = $this->requestStack->getCurrentRequest()->attributes->get(
            RequestIdListener::REQUEST_ID_ATTRIBUTE_KEY
        );

        $payload = Json::encode(['arguments' => $arguments]);

        $headers = ['Frontastic-Request-Id' => "Frontastic-Request-Id:$requestId"];

        try {
            return $this->doCallAsync($this->getProjectIdentifier(), $extensionName, $payload, $headers);
        } catch (\Exception $exception) {
            return Create::promiseFor(Json::encode([
                'ok' => false,
                'message' => $exception->getMessage()
            ]));
        }
    }

    /**
     * @throws \Exception
     */
    private function doCallAsync(
        string $project,
        string $extensionName,
        string $payload,
        ?array $headers
    ): PromiseInterface {
        $path = $this->makePath('run', $project, $extensionName);
        $requestHeaders = $headers + self::DEFAULT_HEADERS;

        return $this->httpClient->postAsync($path, $payload, $requestHeaders)->then(
            function (Response $response) use ($extensionName) {
                if ($response->status != 200) {
                    throw new \Exception('Calling extension ' . $extensionName . ' failed. Error: ' . $response->body);
                }

                return $response->body;
            }
        );
    }


    private function makePath(string ...$uri): string
    {
        return self::BASE_PATH . implode("/", $uri);
    }
}
