<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Frontastic\Catwalk\FrontendBundle\Gateway\PageGateway' shared service.

$a = ($this->services['doctrine.orm.default_entity_manager'] ?? $this->load('getDoctrine_Orm_DefaultEntityManagerService.php'));

return $this->services['Frontastic\\Catwalk\\FrontendBundle\\Gateway\\PageGateway'] = new \Frontastic\Catwalk\FrontendBundle\Gateway\PageGateway($a->getRepository('Frontastic\\Catwalk\\FrontendBundle\\Domain\\Page'), $a);
