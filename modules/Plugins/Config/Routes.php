<?php

declare(strict_types=1);

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->group(
    config('Admin')
->gateway,
    [
        'namespace' => 'Modules\Plugins\Controllers',
    ],
    static function ($routes): void {
        $routes->group('plugins', static function ($routes): void {
            $routes->get('/', 'PluginsController::installed', [
                'as'     => 'plugins-installed',
                'filter' => 'permission:plugins.manage',
            ]);
            $routes->post('activate/(:segment)', 'PluginsController::activate/$1', [
                'as'     => 'plugins-activate',
                'filter' => 'permission:plugins.manage',
            ]);
            $routes->post('deactivate/(:segment)', 'PluginsController::deactivate/$1', [
                'as'     => 'plugins-deactivate',
                'filter' => 'permission:plugins.manage',
            ]);
        });
    }
);
