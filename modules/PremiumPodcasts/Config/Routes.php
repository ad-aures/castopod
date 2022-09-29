<?php

declare(strict_types=1);

namespace Modules\PremiumPodcasts\Config;

$routes = service('routes');

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
                'as' => 'subscription-list',
                'filter' =>
                    'permission:podcasts-view,podcast-manage_subscriptions',
            ]);
            $routes->get('add', 'SubscriptionController::add/$1', [
                'as' => 'subscription-add',
                'filter' => 'permission:podcast-manage_subscriptions',
            ]);
            $routes->post(
                'add',
                'SubscriptionController::attemptAdd/$1',
                [
                    'filter' =>
                        'permission:podcast-manage_subscriptions',
                ],
            );
            $routes->post('save-link', 'SubscriptionController::attemptLinkSave/$1', [
                'as' => 'subscription-link-save',
                'filter' => 'permission:podcast-manage_subscriptions',
            ]);
            // Subscription
            $routes->group('(:num)', static function ($routes): void {
                $routes->get('/', 'SubscriptionController::view/$1/$2', [
                    'as' => 'subscription-view',
                    'filter' =>
                        'permission:podcast-manage_subscriptions',
                ]);
                $routes->get(
                    'edit',
                    'SubscriptionController::edit/$1/$2',
                    [
                        'as' => 'subscription-edit',
                        'filter' =>
                            'permission:podcast-manage_subscriptions',
                    ],
                );
                $routes->post(
                    'edit',
                    'SubscriptionController::attemptEdit/$1/$2',
                    [
                        'as' => 'subscription-edit',
                        'filter' =>
                            'permission:podcast-manage_subscriptions',
                    ],
                );
                $routes->get(
                    'regenerate-token',
                    'SubscriptionController::regenerateToken/$1/$2',
                    [
                        'as' => 'subscription-regenerate-token',
                        'filter' =>
                            'permission:podcast-manage_subscriptions',
                    ]
                );
                $routes->get(
                    'suspend',
                    'SubscriptionController::suspend/$1/$2',
                    [
                        'as' => 'subscription-suspend',
                        'filter' =>
                            'permission:podcast-manage_subscriptions',
                    ],
                );
                $routes->post(
                    'suspend',
                    'SubscriptionController::attemptSuspend/$1/$2',
                    [
                        'filter' =>
                        'permission:podcast-manage_subscriptions',
                    ],
                );
                $routes->get(
                    'resume',
                    'SubscriptionController::resume/$1/$2',
                    [
                        'as' => 'subscription-resume',
                        'filter' =>
                            'permission:podcast-manage_subscriptions',
                    ],
                );
                $routes->get(
                    'delete',
                    'SubscriptionController::delete/$1/$2',
                    [
                        'as' => 'subscription-delete',
                        'filter' =>
                            'permission:podcast-manage_subscriptions',
                    ],
                );
                $routes->post(
                    'delete',
                    'SubscriptionController::attemptDelete/$1/$2',
                    [
                        'filter' =>
                            'permission:podcast-manage_subscriptions',
                    ],
                );
            });
        });
    }
);

$routes->group(
    '@(:podcastHandle)',
    [
        'namespace' => 'Modules\PremiumPodcasts\Controllers',
    ],
    static function ($routes): void {
        $routes->get('unlock', 'LockController/$1', [
            'as' => 'premium-podcast-unlock',
        ]);
        $routes->post('unlock', 'LockController::attemptUnlock/$1', [
            'as' => 'premium-podcast-unlock',
        ]);
        $routes->get('lock', 'LockController::attemptLock/$1', [
            'as' => 'premium-podcast-lock',
        ]);
    }
);
