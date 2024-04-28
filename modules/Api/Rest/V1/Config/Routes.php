<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Config;

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group(
    config('RestApi')
        ->gateway . 'podcasts',
    [
        'namespace' => 'Modules\Api\Rest\V1\Controllers',
        'filter'    => 'rest-api',
    ],
    static function ($routes): void {
        $routes->get('/', 'PodcastController::list');
        $routes->get('(:num)', 'PodcastController::view/$1');
        $routes->get('(:any)', 'ExceptionController::notFound');
    }
);

$routes->group(
    config('RestApi')
        ->gateway . 'episodes',
    [
        'namespace' => 'Modules\Api\Rest\V1\Controllers',
        'filter'    => 'rest-api',
    ],
    static function ($routes): void {
        $routes->get('/', 'EpisodeController::list');
        $routes->get('(:num)', 'EpisodeController::view/$1');
        $routes->get('(:any)', 'ExceptionController::notFound');
    }
);
