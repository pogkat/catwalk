<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'Frontastic\Common\ShopwareBundle\Domain\CartApi\DataMapper\OrdersMapper' shared autowired service.

return $this->privates['Frontastic\\Common\\ShopwareBundle\\Domain\\CartApi\\DataMapper\\OrdersMapper'] = new \Frontastic\Common\ShopwareBundle\Domain\CartApi\DataMapper\OrdersMapper(($this->privates['Frontastic\\Common\\ShopwareBundle\\Domain\\CartApi\\DataMapper\\OrderMapper'] ?? $this->load('getOrderMapperService.php')));
