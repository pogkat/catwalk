<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Frontastic\Catwalk\FrontendBundle\Security\AccountProvider' shared service.

return $this->services['Frontastic\\Catwalk\\FrontendBundle\\Security\\AccountProvider'] = new \Frontastic\Catwalk\FrontendBundle\Security\AccountProvider(($this->services['Frontastic\\Common\\AccountApiBundle\\Domain\\AccountService'] ?? $this->load('getAccountServiceService.php')), ($this->services['Frontastic\\Catwalk\\ApiCoreBundle\\Domain\\ContextService'] ?? $this->getContextServiceService()));
