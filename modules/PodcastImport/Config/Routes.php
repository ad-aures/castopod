<?php

declare(strict_types=1);

namespace Modules\PodcastImport\Config;

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes = service('routes');

// Admin routes for imports
$routes->group(
    config('Admin')
        ->gateway,
    [
        'namespace' => 'Modules\PodcastImport\Controllers',
    ],
    static function ($routes): void {
        $routes->get('imports', 'PodcastImportController::list', [
            'as'     => 'all-podcast-imports',
            'filter' => 'permission:podcasts.import',
        ]);
        $routes->get('imports/add', 'PodcastImportController::addToQueueView', [
            'as'     => 'podcast-imports-add',
            'filter' => 'permission:podcasts.import',
        ]);
        $routes->post('imports/add', 'PodcastImportController::addToQueueAction', [
            'filter' => 'permission:podcasts.import',
        ]);
        $routes->get('imports/(:segment)/(:alpha)', 'PodcastImportController::taskAction/$1/$2', [
            'as'     => 'podcast-imports-task-action',
            'filter' => 'permission:podcasts.import',
        ]);

        $routes->group('podcasts/(:num)', static function ($routes): void {
            $routes->get('imports', 'PodcastImportController::podcastList/$1', [
                'as'     => 'podcast-imports',
                'filter' => 'permission:podcast#.manage-import',
            ]);
            $routes->get('sync-feed', 'PodcastImportController::syncImport/$1', [
                'as'     => 'podcast-imports-sync',
                'filter' => 'permission:podcast#.manage-import',
            ]);
        });
    }
);
