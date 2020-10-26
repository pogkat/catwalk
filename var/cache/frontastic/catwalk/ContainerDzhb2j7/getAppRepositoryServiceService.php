<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Frontastic\Catwalk\ApiCoreBundle\Domain\AppRepositoryService' shared service.

return $this->services['Frontastic\\Catwalk\\ApiCoreBundle\\Domain\\AppRepositoryService'] = new \Frontastic\Catwalk\ApiCoreBundle\Domain\AppRepositoryService(($this->services['doctrine.orm.default_entity_manager'] ?? $this->load('getDoctrine_Orm_DefaultEntityManagerService.php')), ($this->services['Frontastic\\Catwalk\\ApiCoreBundle\\Gateway\\AppGateway'] ?? $this->load('getAppGatewayService.php')), ($this->services['logger'] ?? $this->getLoggerService()));
