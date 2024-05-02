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
            $routes->get('/', 'PluginController::installed', [
                'as'     => 'plugins-installed',
                'filter' => 'permission:plugins.manage',
            ]);
            $routes->get('(:segment)', 'PluginController::generalSettings/$1', [
                'as'     => 'plugins-general-settings',
                'filter' => 'permission:plugins.manage',
            ]);
            $routes->post('(:segment)', 'PluginController::generalSettingsAction/$1', [
                'as'     => 'plugins-general-settings-action',
                'filter' => 'permission:plugins.manage',
            ]);
            $routes->post('activate/(:segment)', 'PluginController::activate/$1', [
                'as'     => 'plugins-activate',
                'filter' => 'permission:plugins.manage',
            ]);
            $routes->post('deactivate/(:segment)', 'PluginController::deactivate/$1', [
                'as'     => 'plugins-deactivate',
                'filter' => 'permission:plugins.manage',
            ]);
        });
        $routes->group('podcasts/(:num)/plugins', static function ($routes): void {
            $routes->get('(:segment)', 'PluginController::podcastSettings/$1/$2', [
                'as'     => 'plugins-podcast-settings',
                'filter' => 'permission:podcast#.edit',
            ]);
            $routes->post('(:segment)', 'PluginController::podcastSettingsAction/$1/$2', [
                'as'     => 'plugins-podcast-settings-action',
                'filter' => 'permission:podcast#.edit',
            ]);
        });
        $routes->group('podcasts/(:num)/episodes/(:num)/plugins', static function ($routes): void {
            $routes->get('(:segment)', 'PluginController::episodeSettings/$1/$2/$3', [
                'as'     => 'plugins-episode-settings',
                'filter' => 'permission:podcast#.edit',
            ]);
            $routes->post('(:segment)', 'PluginController::episodeSettingsAction/$1/$2/$3', [
                'as'     => 'plugins-episode-settings-action',
                'filter' => 'permission:podcast#.edit',
            ]);
        });
    }
);
