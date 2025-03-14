<?php

declare(strict_types=1);

namespace Modules\PremiumPodcasts\Config;

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->addPlaceholder('podcastHandle', '[a-zA-Z0-9\_]{1,32}');

// Admin routes for subscriptions
$routes->group(
    config('Admin')
        ->gateway,
    [
        'namespace' => 'Modules\PremiumPodcasts\Controllers',
    ],
    static function ($routes): void {
        $routes->group('podcasts/(:num)/subscriptions', static function ($routes): void {
            $routes->get('/', 'SubscriptionController::list/$1', [
                'as'     => 'subscription-list',
                'filter' => 'permission:podcast$1.manage-subscriptions',
            ]);
            $routes->get('new', 'SubscriptionController::createView/$1', [
                'as'     => 'subscription-create',
                'filter' => 'permission:podcast$1.manage-subscriptions',
            ]);
            $routes->post(
                'new',
                'SubscriptionController::createAction/$1',
                [
                    'filter' => 'permission:podcast$1.manage-subscriptions',
                ],
            );
            $routes->post('save-link', 'SubscriptionController::linkSaveAction/$1', [
                'as'     => 'subscription-link-save',
                'filter' => 'permission:podcast$1.manage-subscriptions',
            ]);
            // Subscription
            $routes->group('(:num)', static function ($routes): void {
                $routes->get('/', 'SubscriptionController::view/$1/$2', [
                    'as'     => 'subscription-view',
                    'filter' => 'permission:podcast$1.manage-subscriptions',
                ]);
                $routes->get(
                    'edit',
                    'SubscriptionController::editView/$1/$2',
                    [
                        'as'     => 'subscription-edit',
                        'filter' => 'permission:podcast$1.manage-subscriptions',
                    ],
                );
                $routes->post(
                    'edit',
                    'SubscriptionController::editAction/$1/$2',
                    [
                        'as'     => 'subscription-edit',
                        'filter' => 'permission:podcast$1.manage-subscriptions',
                    ],
                );
                $routes->get(
                    'regenerate-token',
                    'SubscriptionController::regenerateToken/$1/$2',
                    [
                        'as'     => 'subscription-regenerate-token',
                        'filter' => 'permission:podcast$1.manage-subscriptions',
                    ],
                );
                $routes->get(
                    'suspend',
                    'SubscriptionController::suspend/$1/$2',
                    [
                        'as'     => 'subscription-suspend',
                        'filter' => 'permission:podcast$1.manage-subscriptions',
                    ],
                );
                $routes->post(
                    'suspend',
                    'SubscriptionController::suspendAction/$1/$2',
                    [
                        'filter' => 'permission:podcast$1.manage-subscriptions',
                    ],
                );
                $routes->get(
                    'resume',
                    'SubscriptionController::resume/$1/$2',
                    [
                        'as'     => 'subscription-resume',
                        'filter' => 'permission:podcast$1.manage-subscriptions',
                    ],
                );
                $routes->get(
                    'delete',
                    'SubscriptionController::delete/$1/$2',
                    [
                        'as'     => 'subscription-delete',
                        'filter' => 'permission:podcast$1.manage-subscriptions',
                    ],
                );
                $routes->post(
                    'delete',
                    'SubscriptionController::deleteAction/$1/$2',
                    [
                        'filter' => 'permission:podcast$1.manage-subscriptions',
                    ],
                );
            });
        });
    },
);

$routes->group(
    '@(:podcastHandle)',
    [
        'namespace' => 'Modules\PremiumPodcasts\Controllers',
    ],
    static function ($routes): void {
        $routes->get('unlock', 'LockController::index/$1', [
            'as' => 'premium-podcast-unlock',
        ]);
        $routes->post('unlock', 'LockController::unlockAction/$1', [
            'as' => 'premium-podcast-unlock',
        ]);
        $routes->get('lock', 'LockController::lockAction/$1', [
            'as' => 'premium-podcast-lock',
        ]);
    },
);
