<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'frontastic.catwalk.frontend_bundle.domain.project_configuration.replication_target' shared service.

return $this->services['frontastic.catwalk.frontend_bundle.domain.project_configuration.replication_target'] = new \Frontastic\Catwalk\ApiCoreBundle\Domain\EnvironmentReplicationFilter(($this->services['Frontastic\\Catwalk\\FrontendBundle\\Domain\\ProjectConfigurationService'] ?? $this->load('getProjectConfigurationServiceService.php')), 'production');
