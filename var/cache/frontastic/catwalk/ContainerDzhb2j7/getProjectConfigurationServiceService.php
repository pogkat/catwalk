<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Frontastic\Catwalk\FrontendBundle\Domain\ProjectConfigurationService' shared service.

return $this->services['Frontastic\\Catwalk\\FrontendBundle\\Domain\\ProjectConfigurationService'] = new \Frontastic\Catwalk\FrontendBundle\Domain\ProjectConfigurationService(($this->services['Frontastic\\Catwalk\\FrontendBundle\\Gateway\\ProjectConfigurationGateway'] ?? $this->load('getProjectConfigurationGatewayService.php')));
