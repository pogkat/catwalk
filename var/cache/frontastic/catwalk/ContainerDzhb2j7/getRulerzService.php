<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'rulerz' shared service.

$this->privates['rulerz'] = $instance = new \RulerZ\RulerZ(new \RulerZ\Compiler\Compiler(new \RulerZ\Compiler\FileEvaluator(($this->targetDir.''.'/rulerz'))));

$a = new \RulerZ\Target\Native\Native();
$a->defineInlineOperator('contains', ($this->services['Frontastic\\Catwalk\\FrontendBundle\\RulerZ\\Operator\\ArrayContains'] ?? ($this->services['Frontastic\\Catwalk\\FrontendBundle\\RulerZ\\Operator\\ArrayContains'] = new \Frontastic\Catwalk\FrontendBundle\RulerZ\Operator\ArrayContains())));
$a->defineOperator('categoriescontain', ($this->services['Frontastic\\Catwalk\\FrontendBundle\\RulerZ\\Operator\\CategoriesContain'] ?? $this->load('getCategoriesContainService.php')));
$a->defineOperator('categorypathcontains', ($this->services['Frontastic\\Catwalk\\FrontendBundle\\RulerZ\\Operator\\CategoryPathContains'] ?? ($this->services['Frontastic\\Catwalk\\FrontendBundle\\RulerZ\\Operator\\CategoryPathContains'] = new \Frontastic\Catwalk\FrontendBundle\RulerZ\Operator\CategoryPathContains())));

$instance->registerCompilationTarget($a);

return $instance;