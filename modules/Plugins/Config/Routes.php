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
        $routes->get('plugins', 'PluginsController', [
            'as'     => 'plugins',
            'filter' => 'permission:podcasts.import',
        ]);
    }
);
