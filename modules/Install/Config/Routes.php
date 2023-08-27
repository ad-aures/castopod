<?php

declare(strict_types=1);

namespace Modules\Install\Config;

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Install Wizard routes
$routes->group(
    config(Install::class)
        ->gateway,
    [
        'namespace' => 'Modules\Install\Controllers',
    ],
    static function ($routes): void {
        $routes->get('/', 'InstallController', [
            'as' => 'install',
        ]);
        $routes->post('instance-config', 'InstallController::attemptInstanceConfig', [
            'as' => 'instance-config',
        ]);
        $routes->post('database-config', 'InstallController::attemptDatabaseConfig', [
            'as' => 'database-config',
        ]);
        $routes->post('cache-config', 'InstallController::attemptCacheConfig', [
            'as' => 'cache-config',
        ]);
        $routes->post(
            'create-superadmin',
            'InstallController::attemptCreateSuperAdmin',
            [
                'as' => 'create-superadmin',
            ],
        );
    }
);
