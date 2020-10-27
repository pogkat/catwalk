<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Frontastic\Common\CoreBundle\Domain\Mailer' shared service.

return $this->services['Frontastic\\Common\\CoreBundle\\Domain\\Mailer'] = new \Frontastic\Common\CoreBundle\Domain\Mailer\SwiftMail(($this->services['swiftmailer.mailer.default'] ?? $this->load('getSwiftmailer_Mailer_DefaultService.php')), ($this->services['templating'] ?? $this->load('getTemplatingService.php')), $this->getEnv('smtp_sender'));