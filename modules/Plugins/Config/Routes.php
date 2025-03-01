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
            $routes->get('(:segment)', 'PluginController::vendor/$1', [
                'as'     => 'plugins-vendor',
                'filter' => 'permission:plugins.manage',
            ]);
            $routes->group('(:segment)/(:segment)', static function ($routes): void {
                $routes->get('/', 'PluginController::view/$1/$2', [
                    'as'     => 'plugins-view',
                    'filter' => 'permission:plugins.manage',
                ]);
                $routes->get('settings', 'PluginController::settingsView/$1/$2', [
                    'as'     => 'plugins-settings-general',
                    'filter' => 'permission:plugins.manage',
                ]);
                $routes->post('settings', 'PluginController::settingsAction/$1/$2', [
                    'as'     => 'plugins-settings-general-action',
                    'filter' => 'permission:plugins.manage',
                ]);
                $routes->get('(:num)', 'PluginController::settingsView/$1/$2/$3', [
                    'as'     => 'plugins-settings-podcast',
                    'filter' => 'permission:podcast$3.edit',
                ]);
                $routes->post('(:num)', 'PluginController::settingsAction/$1/$2/$3', [
                    'as'     => 'plugins-settings-podcast-action',
                    'filter' => 'permission:podcast$3.edit',
                ]);
                $routes->get('(:num)/(:num)', 'PluginController::settingsView/$1/$2/$3/$4', [
                    'as'     => 'plugins-settings-episode',
                    'filter' => 'permission:podcast$3.episodes.edit',
                ]);
                $routes->post('(:num)/(:num)', 'PluginController::settingsAction/$1/$2/$3/$4', [
                    'as'     => 'plugins-settings-episode-action',
                    'filter' => 'permission:podcast$3.episodes.edit',
                ]);
                $routes->post('activate', 'PluginController::activate/$1/$2', [
                    'as'     => 'plugins-activate',
                    'filter' => 'permission:plugins.manage',
                ]);
                $routes->post('deactivate', 'PluginController::deactivate/$1/$2', [
                    'as'     => 'plugins-deactivate',
                    'filter' => 'permission:plugins.manage',
                ]);
                $routes->get('uninstall', 'PluginController::uninstall/$1/$2', [
                    'as'     => 'plugins-uninstall',
                    'filter' => 'permission:plugins.manage',
                ]);
            });
        });
    },
);
