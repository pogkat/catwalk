<?php

namespace Frontastic\Catwalk\FrontendBundle\Controller;

use Frontastic\Catwalk\ApiCoreBundle\Domain\Context;
use Frontastic\Catwalk\FrontendBundle\Domain\MasterService;
use Frontastic\Catwalk\FrontendBundle\Domain\NodeService;
use Frontastic\Catwalk\FrontendBundle\Domain\PageMatcher\PageMatcherContext;
use Frontastic\Catwalk\FrontendBundle\Domain\PageService;
use Frontastic\Catwalk\FrontendBundle\Domain\ViewDataProvider;
use Frontastic\Catwalk\TrackingBundle\Domain\TrackingService;
use Symfony\Component\HttpFoundation\Request;

class SearchController
{
    private MasterService $masterService;
    private NodeService $nodeService;
    private ViewDataProvider $viewDataProvider;
    private PageService $pageService;
    private TrackingService $trackingService;

    public function __construct(
        MasterService $masterService,
        NodeService $nodeService,
        ViewDataProvider $viewDataProvider,
        PageService $pageService,
        TrackingService $trackingService
    ) {
        $this->masterService = $masterService;
        $this->nodeService = $nodeService;
        $this->viewDataProvider = $viewDataProvider;
        $this->pageService = $pageService;
        $this->trackingService = $trackingService;
    }

    public function searchAction(Request $request, Context $context, string $phrase): array
    {
        $pageMatcherService = $this->masterService;
        $nodeService = $this->nodeService;
        $dataProvider = $this->viewDataProvider;
        $pageService = $this->pageService;
        $masterService = $this->masterService;

        $node = $nodeService->get($pageMatcherService->matchNodeId(new PageMatcherContext(['search' => $phrase])));
        $node->nodeType = 'search';
        $node->streams = $pageMatcherService->completeDefaultQuery($node->streams, 'search', $phrase);

        $parameters = array_merge_recursive(
            $request->query->get('s', []),
            ['__master' => ['query' => $phrase]]
        );

        $page = $pageService->fetchForNode($node, $context);

        $masterService->completeTasticStreamConfigurationWithMasterDefault($page, 'search');

        $this->trackingService->trackPageView($context, $node->nodeType);

        return [
            'node' => $node,
            'page' => $page,
            'data' => $dataProvider->fetchDataFor($node, $context, $parameters, $page),
        ];
    }
}
