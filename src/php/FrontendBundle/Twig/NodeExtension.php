<?php

namespace Frontastic\Catwalk\FrontendBundle\Twig;

use Frontastic\Catwalk\FrontendBundle\Domain\NodeService;
use Frontastic\Catwalk\ApiCoreBundle\Domain\TasticService;
use Frontastic\Catwalk\FrontendBundle\Domain\FacetService;
use Frontastic\Common\ProductApiBundle\Domain\ProductApi;
use Frontastic\Common\ProductApiBundle\Domain\ProductApi\Query\CategoryQuery;
use Frontastic\Catwalk\ApiCoreBundle\Domain\Context;
use Symfony\Component\DependencyInjection\ContainerInterface;

class NodeExtension extends \Twig_Extension
{
    private $facetService;

    private $productApi;

    private $context;

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions(): array
    {
        return [
            new \Twig_Function('frontastic_tree', [$this->container->get(NodeService::class), 'getTree']),
            new \Twig_Function('completeInformation', [$this, 'completeInformation']),
        ];
    }

    public function completeInformation(array $variables): array
    {
        $context = $this->container->get(Context::class);
        $request = $this->container->get('request_stack')->getCurrentRequest();

        return array_merge(
            [
                'node' => null,
                'page' => null,
                'data' => null,
                'tastics' => $this->container->get(TasticService::class)->getAll(),
                'facets' => $this->container->get(FacetService::class)->getEnabled(),
                'categories' => $this->container->get(ProductApi::class)->getCategories(
                    new CategoryQuery([
                        'locale' => $context->locale,
                        'limit' => 100,
                    ])
                ),
                'route' => [
                    'route' => $request->get('_route'),
                    'parameters' => array_merge(
                        $request->query->all(),
                        array_filter(
                            $request->attributes->all(),
                            function ($value, $key) {
                                return $key[0] !== '_' && ($key !== 'nodeId') && is_string($value);
                            },
                            ARRAY_FILTER_USE_BOTH
                        )
                    ),
                ],
            ],
            $variables
        );
    }
}
