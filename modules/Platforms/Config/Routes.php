<?php

declare(strict_types=1);

namespace Modules\PremiumPodcasts\Config;

use CodeIgniter\Router\RouteCollection;
use Modules\Admin\Config\Admin;

$routes->addPlaceholder('platformType', '\bpodcasting|\bsocial|\bfunding');

/** @var RouteCollection $routes */

// Admin routes for subscriptions
$routes->group(
    config(Admin::class)
        ->gateway,
    [
        'namespace' => 'Modules\Platforms\Controllers',
    ],
    static function ($routes): void {
        $routes->group('podcasts/(:num)/platforms', static function ($routes): void {
            $routes->get(
                '/',
                'PlatformController::platforms/$1/podcasting',
                [
                    'as'     => 'platforms-podcasting',
                    'filter' => 'permission:podcast#.manage-platforms',
                ],
            );
            $routes->get(
                'social',
                'PlatformController::platforms/$1/social',
                [
                    'as'     => 'platforms-social',
                    'filter' => 'permission:podcast#.manage-platforms',
                ],
            );
            $routes->get(
                'funding',
                'PlatformController::platforms/$1/funding',
                [
                    'as'     => 'platforms-funding',
                    'filter' => 'permission:podcast#.manage-platforms',
                ],
            );
            $routes->post(
                'save/(:platformType)',
                'PlatformController::attemptPlatformsUpdate/$1/$2',
                [
                    'as'     => 'platforms-save',
                    'filter' => 'permission:podcast#.manage-platforms',
                ],
            );
            $routes->get(
                '(:platformType)/(:slug)/podcast-platform-remove',
                'PlatformController::removePlatform/$1/$2/$3',
                [
                    'as'     => 'podcast-platform-remove',
                    'filter' => 'permission:podcast#.manage-platforms',
                ],
            );
        });
    }
);
