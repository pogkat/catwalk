<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Frontastic\Catwalk\FrontendBundle\Twig\JsonExtension' shared service.

return $this->services['Frontastic\\Catwalk\\FrontendBundle\\Twig\\JsonExtension'] = new \Frontastic\Catwalk\FrontendBundle\Twig\JsonExtension(($this->services['Frontastic\\Common\\JsonSerializer'] ?? $this->load('getJsonSerializerService.php')));