<?php

declare(strict_types=1);

namespace Modules\Install\Config;

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Install Wizard routes
$routes->group(
    config('Install')
        ->gateway,
    [
        'namespace' => 'Modules\Install\Controllers',
    ],
    static function ($routes): void {
        $routes->get('/', 'InstallController', [
            'as' => 'install',
        ]);
        $routes->post('instance-config', 'InstallController::instanceConfigAction', [
            'as' => 'instance-config',
        ]);
        $routes->post('database-config', 'InstallController::databaseConfigAction', [
            'as' => 'database-config',
        ]);
        $routes->post('cache-config', 'InstallController::cacheConfigAction', [
            'as' => 'cache-config',
        ]);
        $routes->post(
            'create-superadmin',
            'InstallController::createSuperAdminAction',
            [
                'as' => 'create-superadmin',
            ],
        );
    }
);
