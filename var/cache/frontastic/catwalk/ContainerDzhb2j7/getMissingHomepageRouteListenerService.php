<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Frontastic\Catwalk\FrontendBundle\EventListener\MissingHomepageRouteListener' shared service.

return $this->services['Frontastic\\Catwalk\\FrontendBundle\\EventListener\\MissingHomepageRouteListener'] = new \Frontastic\Catwalk\FrontendBundle\EventListener\MissingHomepageRouteListener(($this->services['templating'] ?? $this->load('getTemplatingService.php')), false);
