<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Config;

$routes = service('routes');

$routes->group(
    config('Api')
        ->gateway . 'podcasts',
    [
        'namespace' => 'Modules\Api\Rest\V1\Controllers',
        'filter' => 'rest-api',
    ],
    function ($routes): void {
        $routes->get('/', 'PodcastController::list');
        $routes->get('(:num)', 'PodcastController::view/$1');
        $routes->get('(:any)', 'ExceptionController::notFound');
    }
);
