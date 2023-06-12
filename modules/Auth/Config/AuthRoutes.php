<?php

declare(strict_types=1);

namespace Modules\Auth\Config;

use CodeIgniter\Shield\Config\AuthRoutes as ShieldAuthRoutes;

class AuthRoutes extends ShieldAuthRoutes
{
    public array $routes = [
        'register' => [
            ['get', 'register', 'RegisterController::registerView', 'register'],
            ['post', 'register', 'RegisterController::registerAction'],
        ],
        'login' => [
            ['get', 'login', 'LoginController::loginView', 'login'],
            ['post', 'login', 'LoginController::loginAction'],
        ],
        'magic-link' => [
            [
                'get',
                'login/magic-link',
                'MagicLinkController::loginView',
                'magic-link',        // Route name
            ],
            ['post', 'login/magic-link', 'MagicLinkController::loginAction'],
            [
                'get',
                'login/verify-magic-link',
                'MagicLinkController::verify',
                'verify-magic-link', // Route name
            ],
        ],
        'logout'       => [['get', 'logout', 'LoginController::logoutAction', 'logout']],
        'auth-actions' => [
            ['get', 'auth/a/show', 'ActionController::show', 'auth-action-show'],
            ['post', 'auth/a/handle', 'ActionController::handle', 'auth-action-handle'],
            ['post', 'auth/a/verify', 'ActionController::verify', 'auth-action-verify'],
        ],
    ];
}
