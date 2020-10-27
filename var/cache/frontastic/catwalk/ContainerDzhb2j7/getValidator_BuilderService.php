<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'validator.builder' shared service.

$this->privates['validator.builder'] = $instance = \Symfony\Component\Validator\Validation::createValidatorBuilder();

$instance->setConstraintValidatorFactory(new \Symfony\Component\Validator\ContainerConstraintValidatorFactory(new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
    'Symfony\\Bridge\\Doctrine\\Validator\\Constraints\\UniqueEntityValidator' => ['privates', 'doctrine.orm.validator.unique', 'getDoctrine_Orm_Validator_UniqueService.php', true],
    'Symfony\\Bridge\\RulerZ\\Validator\\Constraints\\RuleValidator' => ['privates', 'rulerz.validator.unique.rule_validator', 'getRulerz_Validator_Unique_RuleValidatorService.php', true],
    'Symfony\\Component\\Security\\Core\\Validator\\Constraints\\UserPasswordValidator' => ['privates', 'security.validator.user_password', 'getSecurity_Validator_UserPasswordService.php', true],
    'Symfony\\Component\\Validator\\Constraints\\EmailValidator' => ['privates', 'validator.email', 'getValidator_EmailService.php', true],
    'Symfony\\Component\\Validator\\Constraints\\ExpressionValidator' => ['privates', 'validator.expression', 'getValidator_ExpressionService.php', true],
    'Symfony\\Component\\Validator\\Constraints\\NotCompromisedPasswordValidator' => ['privates', 'validator.not_compromised_password', 'getValidator_NotCompromisedPasswordService.php', true],
    'doctrine.orm.validator.unique' => ['privates', 'doctrine.orm.validator.unique', 'getDoctrine_Orm_Validator_UniqueService.php', true],
    'rulerz_rule_validator' => ['privates', 'rulerz.validator.unique.rule_validator', 'getRulerz_Validator_Unique_RuleValidatorService.php', true],
    'security.validator.user_password' => ['privates', 'security.validator.user_password', 'getSecurity_Validator_UserPasswordService.php', true],
    'validator.expression' => ['privates', 'validator.expression', 'getValidator_ExpressionService.php', true],
], [
    'Symfony\\Bridge\\Doctrine\\Validator\\Constraints\\UniqueEntityValidator' => '?',
    'Symfony\\Bridge\\RulerZ\\Validator\\Constraints\\RuleValidator' => '?',
    'Symfony\\Component\\Security\\Core\\Validator\\Constraints\\UserPasswordValidator' => '?',
    'Symfony\\Component\\Validator\\Constraints\\EmailValidator' => '?',
    'Symfony\\Component\\Validator\\Constraints\\ExpressionValidator' => '?',
    'Symfony\\Component\\Validator\\Constraints\\NotCompromisedPasswordValidator' => '?',
    'doctrine.orm.validator.unique' => '?',
    'rulerz_rule_validator' => '?',
    'security.validator.user_password' => '?',
    'validator.expression' => '?',
])));
$instance->setTranslator(new \Symfony\Component\Validator\Util\LegacyTranslatorProxy(($this->services['translator'] ?? ($this->services['translator'] = new \Symfony\Component\Translation\IdentityTranslator()))));
$instance->setTranslationDomain('validators');
$instance->addXmlMappings([0 => (\dirname(__DIR__, 5).'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/config/validation.xml')]);
$instance->addMethodMapping('loadValidatorMetadata');
$instance->setMappingCache(\Symfony\Component\Cache\Adapter\PhpArrayAdapter::create(($this->targetDir.''.'/validation.php'), ($this->privates['cache.validator'] ?? $this->load('getCache_ValidatorService.php'))));
$instance->addObjectInitializers([0 => new \Symfony\Bridge\Doctrine\Validator\DoctrineInitializer(($this->services['doctrine'] ?? $this->getDoctrineService()))]);
$instance->addLoader(new \Symfony\Bridge\Doctrine\Validator\DoctrineLoader(($this->services['doctrine.orm.default_entity_manager'] ?? $this->load('getDoctrine_Orm_DefaultEntityManagerService.php')), NULL));

return $instance;