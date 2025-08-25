<?php

declare(strict_types=1);

namespace Modules\Auth\Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection
 */

service('auth')
    ->routes($routes);

// Admin routes for users and podcast contributors
$routes->group(
    config('Admin')
        ->gateway,
    [
        'namespace' => 'Modules\Auth\Controllers',
    ],
    static function ($routes): void {
        $routes->get('magic-link-set-password', 'MagicLinkController::setPasswordView', [
            'as' => 'magic-link-set-password',
        ]);
        $routes->post('magic-link-set-password', 'MagicLinkController::setPasswordAction');

        $routes->post('interact-as-actor', 'InteractController::interactAsActorAction', [
            'as' => 'interact-as-actor',
        ]);

        // Users
        $routes->group('users', static function ($routes): void {
            $routes->get('/', 'UserController::list', [
                'as'     => 'user-list',
                'filter' => 'permission:users.manage',
            ]);
            $routes->get('new', 'UserController::createView', [
                'as'     => 'user-create',
                'filter' => 'permission:users.manage',
            ]);
            $routes->post('new', 'UserController::createAction', [
                'filter' => 'permission:users.manage',
            ]);
            // User
            $routes->group('(:num)', static function ($routes): void {
                $routes->get('/', 'UserController::view/$1', [
                    'as'     => 'user-view',
                    'filter' => 'permission:users.manage',
                ]);
                $routes->get('edit', 'UserController::editView/$1', [
                    'as'     => 'user-edit',
                    'filter' => 'permission:users.manage',
                ]);
                $routes->post('edit', 'UserController::editAction/$1', [
                    'filter' => 'permission:users.manage',
                ]);
                $routes->get('delete', 'UserController::delete/$1', [
                    'as'     => 'user-delete',
                    'filter' => 'permission:users.manage',
                ]);
                $routes->post('delete', 'UserController::deleteAction/$1', [
                    'as'     => 'user-delete',
                    'filter' => 'permission:users.manage',
                ]);
            });
        });
        // My account
        $routes->group('my-account', static function ($routes): void {
            $routes->get('/', 'MyAccountController', [
                'as' => 'my-account',
            ]);
            $routes->get('change-password', 'MyAccountController::changePassword', [
                'as' => 'change-password',
            ],);
            $routes->post('change-password', 'MyAccountController::changeAction');
        });

        // Podcast contributors
        $routes->group('podcasts/(:num)/contributors', static function ($routes): void {
            $routes->get('/', 'ContributorController::list/$1', [
                'as'     => 'contributor-list',
                'filter' => 'permission:podcast$1.manage-contributors',
            ]);
            $routes->get('add', 'ContributorController::createView/$1', [
                'as'     => 'contributor-add',
                'filter' => 'permission:podcast$1.manage-contributors',
            ]);
            $routes->post(
                'add',
                'ContributorController::createAction/$1',
                [
                    'filter' => 'permission:podcast$1.manage-contributors',
                ],
            );
            // Contributor
            $routes->group('(:num)', static function ($routes): void {
                $routes->get('/', 'ContributorController::view/$1/$2', [
                    'as'     => 'contributor-view',
                    'filter' => 'permission:podcast$1.manage-contributors',
                ]);
                $routes->get(
                    'edit',
                    'ContributorController::editView/$1/$2',
                    [
                        'as'     => 'contributor-edit',
                        'filter' => 'permission:podcast$1.manage-contributors',
                    ],
                );
                $routes->post(
                    'edit',
                    'ContributorController::editAction/$1/$2',
                    [
                        'filter' => 'permission:podcast$1.manage-contributors',
                    ],
                );
                $routes->get(
                    'remove',
                    'ContributorController::removeView/$1/$2',
                    [
                        'as'     => 'contributor-remove',
                        'filter' => 'permission:podcast$1.manage-contributors',
                    ],
                );
                $routes->post(
                    'remove',
                    'ContributorController::removeAction/$1/$2',
                    [
                        'filter' => 'permission:podcast$1.manage-contributors',
                    ],
                );
            });
        });
    },
);
