<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'security.firewall.map.context.main' shared service.

$a = ($this->services['security.token_storage'] ?? $this->getSecurity_TokenStorageService());
$b = ($this->services['router'] ?? $this->getRouterService());

$c = new \Symfony\Component\Security\Http\HttpUtils($b, $b, '{^https?://%s$}i', NULL);
$d = new \Symfony\Component\Security\Http\Firewall\LogoutListener($a, $c, ($this->services['Frontastic\\Catwalk\\FrontendBundle\\Security\\LogoutSuccessHandler'] ?? ($this->services['Frontastic\\Catwalk\\FrontendBundle\\Security\\LogoutSuccessHandler'] = new \Frontastic\Catwalk\FrontendBundle\Security\LogoutSuccessHandler())), ['csrf_parameter' => '_csrf_token', 'csrf_token_id' => 'logout', 'logout_path' => '/api/account/logout']);
$d->addHandler(new \Symfony\Component\Security\Http\Logout\CsrfTokenClearingLogoutHandler(($this->privates['security.csrf.token_storage'] ?? $this->load('getSecurity_Csrf_TokenStorageService.php'))));
$d->addHandler(new \Symfony\Component\Security\Http\Logout\SessionLogoutHandler());

return $this->privates['security.firewall.map.context.main'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(new RewindableGenerator(function () {
    yield 0 => ($this->privates['security.channel_listener'] ?? $this->load('getSecurity_ChannelListenerService.php'));
    yield 1 => ($this->privates['security.context_listener.0'] ?? $this->load('getSecurity_ContextListener_0Service.php'));
    yield 2 => ($this->privates['security.authentication.listener.guard.main'] ?? $this->load('getSecurity_Authentication_Listener_Guard_MainService.php'));
    yield 3 => ($this->privates['security.authentication.listener.anonymous.main'] ?? $this->load('getSecurity_Authentication_Listener_Anonymous_MainService.php'));
    yield 4 => ($this->privates['security.access_listener'] ?? $this->load('getSecurity_AccessListenerService.php'));
}, 5), new \Symfony\Component\Security\Http\Firewall\ExceptionListener($a, ($this->privates['security.authentication.trust_resolver'] ?? ($this->privates['security.authentication.trust_resolver'] = new \Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver(NULL, NULL))), $c, 'main', ($this->services['Frontastic\\Catwalk\\FrontendBundle\\Security\\Authenticator'] ?? $this->load('getAuthenticatorService.php')), NULL, NULL, ($this->privates['monolog.logger.security'] ?? $this->load('getMonolog_Logger_SecurityService.php')), false), $d, new \Symfony\Bundle\SecurityBundle\Security\FirewallConfig('main', 'security.user_checker', '.security.request_matcher.3UEFixr', true, false, 'Frontastic\\Catwalk\\FrontendBundle\\Security\\AccountProvider', 'main', 'Frontastic\\Catwalk\\FrontendBundle\\Security\\Authenticator', NULL, NULL, [0 => 'guard', 1 => 'anonymous'], NULL));
