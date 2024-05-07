<?php

declare(strict_types=1);

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->addPlaceholder('pluginVendor', '[a-z0-9]([_.-]?[a-z0-9]+)*');
$routes->addPlaceholder('pluginKey', PLUGINS_KEY_PATTERN);

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
            $routes->get('(:pluginVendor)', 'PluginController::vendor/$1', [
                'as'     => 'plugins-vendor',
                'filter' => 'permission:plugins.manage',
            ]);
            $routes->group('(:pluginKey)', static function ($routes): void {
                $routes->get('/', 'PluginController::view/$1/$2', [
                    'as'     => 'plugins-view',
                    'filter' => 'permission:plugins.manage',
                ]);
                $routes->get('settings', 'PluginController::generalSettings/$1/$2', [
                    'as'     => 'plugins-general-settings',
                    'filter' => 'permission:plugins.manage',
                ]);
                $routes->post('settings', 'PluginController::generalSettingsAction/$1/$2', [
                    'as'     => 'plugins-general-settings-action',
                    'filter' => 'permission:plugins.manage',
                ]);
                $routes->post('activate', 'PluginController::activate/$1/$2', [
                    'as'     => 'plugins-activate',
                    'filter' => 'permission:plugins.manage',
                ]);
                $routes->post('deactivate', 'PluginController::deactivate/$1/$2', [
                    'as'     => 'plugins-deactivate',
                    'filter' => 'permission:plugins.manage',
                ]);
                // TODO: change to delete
                $routes->get('uninstall', 'PluginController::uninstall/$1/$2', [
                    'as'     => 'plugins-uninstall',
                    'filter' => 'permission:plugins.manage',
                ]);
            });
        });
        $routes->group('podcasts/(:num)/plugins', static function ($routes): void {
            $routes->get('(:pluginKey)', 'PluginController::podcastSettings/$1/$2/$3', [
                'as'     => 'plugins-podcast-settings',
                'filter' => 'permission:podcast#.edit',
            ]);
            $routes->post('(:pluginKey)', 'PluginController::podcastSettingsAction/$1/$2/$3', [
                'as'     => 'plugins-podcast-settings-action',
                'filter' => 'permission:podcast#.edit',
            ]);
        });
        $routes->group('podcasts/(:num)/episodes/(:num)/plugins', static function ($routes): void {
            $routes->get('(:pluginKey)', 'PluginController::episodeSettings/$1/$2/$3/$4', [
                'as'     => 'plugins-episode-settings',
                'filter' => 'permission:podcast#.edit',
            ]);
            $routes->post('(:pluginKey)', 'PluginController::episodeSettingsAction/$1/$2/$3/$4', [
                'as'     => 'plugins-episode-settings-action',
                'filter' => 'permission:podcast#.edit',
            ]);
        });
    }
);
