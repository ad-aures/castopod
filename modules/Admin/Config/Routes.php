<?php

declare(strict_types=1);

namespace Modules\Admin\Config;

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// video-clips scheduler
$routes->add('scheduled-video-clips', 'SchedulerController::generateVideoClips', [
    'namespace' => 'Modules\Admin\Controllers',
]);

// Admin area routes
$routes->group(
    config('Admin')
        ->gateway,
    [
        'namespace' => 'Modules\Admin\Controllers',
    ],
    static function ($routes): void {
        $routes->get('/', 'DashboardController', [
            'as' => 'admin',
        ]);
        $routes->group('settings', static function ($routes): void {
            $routes->get('/', 'SettingsController', [
                'as'     => 'settings-general',
                'filter' => 'permission:admin.settings',
            ]);
            $routes->post('instance', 'SettingsController::instanceEditAction', [
                'as'     => 'settings-instance',
                'filter' => 'permission:admin.settings',
            ]);
            $routes->get('instance-delete-icon', 'SettingsController::deleteIconAction', [
                'as'     => 'settings-instance-delete-icon',
                'filter' => 'permission:admin.settings',
            ]);
            $routes->post('instance-images-regenerate', 'SettingsController::regenerateImagesAction', [
                'as'     => 'settings-images-regenerate',
                'filter' => 'permission:admin.settings',
            ]);
            $routes->post('instance-housekeeping-run', 'SettingsController::housekeepingAction', [
                'as'     => 'settings-housekeeping-run',
                'filter' => 'permission:admin.settings',
            ]);
            $routes->get('theme', 'SettingsController::themeView', [
                'as'     => 'settings-theme',
                'filter' => 'permission:admin.settings',
            ]);
            $routes->post('theme', 'SettingsController::themeAction', [
                'as'     => 'settings-theme',
                'filter' => 'permission:admin.settings',
            ]);
        });
        $routes->group('persons', static function ($routes): void {
            $routes->get('/', 'PersonController::list', [
                'as'     => 'person-list',
                'filter' => 'permission:persons.manage',
            ]);
            $routes->get('new', 'PersonController::createView', [
                'as'     => 'person-create',
                'filter' => 'permission:persons.manage',
            ]);
            $routes->post('new', 'PersonController::createAction', [
                'filter' => 'permission:persons.manage',
            ]);
            $routes->group('(:num)', static function ($routes): void {
                $routes->get('/', 'PersonController::view/$1', [
                    'as'     => 'person-view',
                    'filter' => 'permission:persons.manage',
                ]);
                $routes->get('edit', 'PersonController::editView/$1', [
                    'as'     => 'person-edit',
                    'filter' => 'permission:persons.manage',
                ]);
                $routes->post('edit', 'PersonController::editAction/$1', [
                    'filter' => 'permission:persons.manage',
                ]);
                $routes->add('delete', 'PersonController::deleteAction/$1', [
                    'as'     => 'person-delete',
                    'filter' => 'permission:persons.manage',
                ]);
            });
        });
        // Podcasts
        $routes->group('podcasts', static function ($routes): void {
            $routes->get('/', 'PodcastController::list', [
                'as' => 'podcast-list',
            ]);
            $routes->get('new', 'PodcastController::createView', [
                'as'     => 'podcast-create',
                'filter' => 'permission:podcasts.create',
            ]);
            $routes->post('new', 'PodcastController::createAction', [
                'filter' => 'permission:podcasts.create',
            ]);
            // Podcast
            // Use ids in admin area to help permission and group lookups
            $routes->group('(:num)', static function ($routes): void {
                $routes->get('/', 'PodcastController::view/$1', [
                    'as'     => 'podcast-view',
                    'filter' => 'permission:podcast$1.view',
                ]);
                $routes->get('edit', 'PodcastController::editView/$1', [
                    'as'     => 'podcast-edit',
                    'filter' => 'permission:podcast$1.edit',
                ]);
                $routes->post('edit', 'PodcastController::editAction/$1', [
                    'filter' => 'permission:podcast$1.edit',
                ]);
                $routes->get(
                    'publish',
                    'PodcastController::publishView/$1',
                    [
                        'as'     => 'podcast-publish',
                        'filter' => 'permission:podcast$1.manage-publications',
                    ],
                );
                $routes->post(
                    'publish',
                    'PodcastController::publishAction/$1',
                    [
                        'filter' => 'permission:podcast$1.manage-publications',
                    ],
                );
                $routes->get(
                    'publish-edit',
                    'PodcastController::publishEditView/$1',
                    [
                        'as'     => 'podcast-publish_edit',
                        'filter' => 'permission:podcast$1.manage-publications',
                    ],
                );
                $routes->post(
                    'publish-edit',
                    'PodcastController::publishEditAction/$1',
                    [
                        'filter' => 'permission:podcast$1.manage-publications',
                    ],
                );
                $routes->get(
                    'publish-cancel',
                    'PodcastController::publishCancelAction/$1',
                    [
                        'as'     => 'podcast-publish-cancel',
                        'filter' => 'permission:podcast$1.manage-publications',
                    ],
                );
                $routes->get('edit/delete-banner', 'PodcastController::deleteBannerAction/$1', [
                    'as'     => 'podcast-banner-delete',
                    'filter' => 'permission:podcast$1.edit',
                ]);
                $routes->get('delete', 'PodcastController::deleteView/$1', [
                    'as'     => 'podcast-delete',
                    'filter' => 'permission:podcast$1.delete',
                ]);
                $routes->post('delete', 'PodcastController::deleteAction/$1', [
                    'filter' => 'permission:podcast$1.delete',
                ]);
                $routes->group('persons', static function ($routes): void {
                    $routes->get('/', 'PodcastPersonController::index/$1', [
                        'as'     => 'podcast-persons-manage',
                        'filter' => 'permission:podcast$1.manage-persons',
                    ]);
                    $routes->post(
                        '/',
                        'PodcastPersonController::createAction/$1',
                        [
                            'filter' => 'permission:podcast$1.manage-persons',
                        ],
                    );
                    $routes->get(
                        '(:num)/remove',
                        'PodcastPersonController::deleteAction/$1/$2',
                        [
                            'as'     => 'podcast-person-remove',
                            'filter' => 'permission:podcast$1.manage-persons',
                        ],
                    );
                });
                $routes->group('analytics', static function ($routes): void {
                    $routes->get('/', 'PodcastController::analyticsView/$1', [
                        'as'     => 'podcast-analytics',
                        'filter' => 'permission:podcast$1.view',
                    ]);
                    $routes->get(
                        'webpages',
                        'PodcastController::analyticsWebpagesView/$1',
                        [
                            'as'     => 'podcast-analytics-webpages',
                            'filter' => 'permission:podcast$1.view',
                        ],
                    );
                    $routes->get(
                        'locations',
                        'PodcastController::analyticsLocationsView/$1',
                        [
                            'as'     => 'podcast-analytics-locations',
                            'filter' => 'permission:podcast$1.view',
                        ],
                    );
                    $routes->get(
                        'unique-listeners',
                        'PodcastController::analyticsUniqueListenersView/$1',
                        [
                            'as'     => 'podcast-analytics-unique-listeners',
                            'filter' => 'permission:podcast$1.view',
                        ],
                    );
                    $routes->get(
                        'listening-time',
                        'PodcastController::analyticsListeningTimeView/$1',
                        [
                            'as'     => 'podcast-analytics-listening-time',
                            'filter' => 'permission:podcast$1.view',
                        ],
                    );
                    $routes->get(
                        'time-periods',
                        'PodcastController::analyticsTimePeriodsView/$1',
                        [
                            'as'     => 'podcast-analytics-time-periods',
                            'filter' => 'permission:podcast$1.view',
                        ],
                    );
                    $routes->get(
                        'players',
                        'PodcastController::analyticsPlayersView/$1',
                        [
                            'as'     => 'podcast-analytics-players',
                            'filter' => 'permission:podcast$1.view',
                        ],
                    );
                });
                // Podcast episodes
                $routes->group('episodes', static function ($routes): void {
                    $routes->get('/', 'EpisodeController::list/$1', [
                        'as'     => 'episode-list',
                        'filter' => 'permission:podcast$1.episodes.view',
                    ]);
                    $routes->get('new', 'EpisodeController::createView/$1', [
                        'as'     => 'episode-create',
                        'filter' => 'permission:podcast$1.episodes.create',
                    ]);
                    $routes->post(
                        'new',
                        'EpisodeController::createAction/$1',
                        [
                            'filter' => 'permission:podcast$1.episodes.create',
                        ],
                    );
                    // Episode
                    $routes->group('(:num)', static function ($routes): void {
                        $routes->get('/', 'EpisodeController::view/$1/$2', [
                            'as'     => 'episode-view',
                            'filter' => 'permission:podcast$1.episodes.view',
                        ]);
                        $routes->get('edit', 'EpisodeController::editView/$1/$2', [
                            'as'     => 'episode-edit',
                            'filter' => 'permission:podcast$1.episodes.edit',
                        ]);
                        $routes->post(
                            'edit',
                            'EpisodeController::editAction/$1/$2',
                            [
                                'filter' => 'permission:podcast$1.episodes.edit',
                            ],
                        );
                        $routes->get(
                            'publish',
                            'EpisodeController::publishView/$1/$2',
                            [
                                'as'     => 'episode-publish',
                                'filter' => 'permission:podcast$1.episodes.manage-publications',
                            ],
                        );
                        $routes->post(
                            'publish',
                            'EpisodeController::publishAction/$1/$2',
                            [
                                'filter' => 'permission:podcast$1.episodes.manage-publications',
                            ],
                        );
                        $routes->get(
                            'publish-edit',
                            'EpisodeController::publishEditView/$1/$2',
                            [
                                'as'     => 'episode-publish_edit',
                                'filter' => 'permission:podcast$1.episodes.manage-publications',
                            ],
                        );
                        $routes->post(
                            'publish-edit',
                            'EpisodeController::publishEditAction/$1/$2',
                            [
                                'filter' => 'permission:podcast$1.episodes.manage-publications',
                            ],
                        );
                        $routes->get(
                            'publish-cancel',
                            'EpisodeController::publishCancelAction/$1/$2',
                            [
                                'as'     => 'episode-publish-cancel',
                                'filter' => 'permission:podcast$1.episodes.manage-publications',
                            ],
                        );
                        $routes->get(
                            'publish-date-edit',
                            'EpisodeController::publishDateEditView/$1/$2',
                            [
                                'as'     => 'episode-publish_date_edit',
                                'filter' => 'permission:podcast$1.episodes.manage-publications',
                            ],
                        );
                        $routes->post(
                            'publish-date-edit',
                            'EpisodeController::publishDateEditAction/$1/$2',
                            [
                                'filter' => 'permission:podcast$1.episodes.manage-publications',
                            ],
                        );
                        $routes->get(
                            'unpublish',
                            'EpisodeController::unpublishView/$1/$2',
                            [
                                'as'     => 'episode-unpublish',
                                'filter' => 'permission:podcast$1.episodes.manage-publications',
                            ],
                        );
                        $routes->post(
                            'unpublish',
                            'EpisodeController::unpublishAction/$1/$2',
                            [
                                'filter' => 'permission:podcast$1.episodes.manage-publications',
                            ],
                        );
                        $routes->get(
                            'delete',
                            'EpisodeController::deleteView/$1/$2',
                            [
                                'as'     => 'episode-delete',
                                'filter' => 'permission:podcast$1.episodes.delete',
                            ],
                        );
                        $routes->post(
                            'delete',
                            'EpisodeController::deleteAction/$1/$2',
                            [
                                'filter' => 'permission:podcast$1.episodes.delete',
                            ],
                        );
                        $routes->get(
                            'transcript-delete',
                            'EpisodeController::transcriptDelete/$1/$2',
                            [
                                'as'     => 'transcript-delete',
                                'filter' => 'permission:podcast$1.episodes.edit',
                            ],
                        );
                        $routes->get(
                            'chapters-delete',
                            'EpisodeController::chaptersDelete/$1/$2',
                            [
                                'as'     => 'chapters-delete',
                                'filter' => 'permission:podcast$1.episodes.edit',
                            ],
                        );
                        $routes->get(
                            'soundbites',
                            'SoundbiteController::list/$1/$2',
                            [
                                'as'     => 'soundbites-list',
                                'filter' => 'permission:podcast$1.episodes.manage-clips',
                            ],
                        );
                        $routes->get(
                            'soundbites/new',
                            'SoundbiteController::createView/$1/$2',
                            [
                                'as'     => 'soundbites-create',
                                'filter' => 'permission:podcast$1.episodes.manage-clips',
                            ],
                        );
                        $routes->post(
                            'soundbites/new',
                            'SoundbiteController::createAction/$1/$2',
                            [
                                'as'     => 'soundbites-create',
                                'filter' => 'permission:podcast$1.episodes.manage-clips',
                            ],
                        );
                        $routes->get(
                            'soundbites/(:num)/delete',
                            'SoundbiteController::deleteAction/$1/$2/$3',
                            [
                                'as'     => 'soundbites-delete',
                                'filter' => 'permission:podcast$1.episodes.manage-clips',
                            ],
                        );
                        $routes->get(
                            'video-clips',
                            'VideoClipsController::list/$1/$2',
                            [
                                'as'     => 'video-clips-list',
                                'filter' => 'permission:podcast$1.episodes.manage-clips',
                            ],
                        );
                        $routes->get(
                            'video-clips/new',
                            'VideoClipsController::createView/$1/$2',
                            [
                                'as'     => 'video-clips-create',
                                'filter' => 'permission:podcast$1.episodes.manage-clips',
                            ],
                        );
                        $routes->post(
                            'video-clips/new',
                            'VideoClipsController::createAction/$1/$2',
                            [
                                'as'     => 'video-clips-create',
                                'filter' => 'permission:podcast$1.episodes.manage-clips',
                            ],
                        );
                        $routes->get(
                            'video-clips/(:num)',
                            'VideoClipsController::view/$1/$2/$3',
                            [
                                'as'     => 'video-clip',
                                'filter' => 'permission:podcast$1.episodes.manage-clips',
                            ],
                        );
                        $routes->get(
                            'video-clips/(:num)/retry',
                            'VideoClipsController::retryAction/$1/$2/$3',
                            [
                                'as'     => 'video-clip-retry',
                                'filter' => 'permission:podcast$1.episodes.manage-clips',
                            ],
                        );
                        $routes->get(
                            'video-clips/(:num)/delete',
                            'VideoClipsController::deleteAction/$1/$2/$3',
                            [
                                'as'     => 'video-clip-delete',
                                'filter' => 'permission:podcast$1.episodes.manage-clips',
                            ],
                        );
                        $routes->get(
                            'embed',
                            'EpisodeController::embedView/$1/$2',
                            [
                                'as'     => 'embed-add',
                                'filter' => 'permission:podcast$1.episodes.edit',
                            ],
                        );
                        $routes->group('persons', static function ($routes): void {
                            $routes->get('/', 'EpisodePersonController::index/$1/$2', [
                                'as'     => 'episode-persons-manage',
                                'filter' => 'permission:podcast$1.episodes.manage-persons',
                            ]);
                            $routes->post(
                                '/',
                                'EpisodePersonController::createAction/$1/$2',
                                [
                                    'filter' => 'permission:podcast$1.episodes.manage-persons',
                                ],
                            );
                            $routes->get(
                                '(:num)/remove',
                                'EpisodePersonController::deleteAction/$1/$2/$3',
                                [
                                    'as'     => 'episode-person-remove',
                                    'filter' => 'permission:podcast$1.episodes.manage-persons',
                                ],
                            );
                        });
                        $routes->group('comments', static function ($routes): void {
                            $routes->post(
                                'new',
                                'EpisodeController::commentCreateAction/$1/$2',
                                [
                                    'as'     => 'comment-attempt-create',
                                    'filter' => 'permission:podcast$1.episodes.manage-comments',
                                ],
                            );
                            $routes->post(
                                '(:uuid)/reply',
                                'EpisodeController::commentReplyAction/$1/$2/$3',
                                [
                                    'as'     => 'comment-attempt-reply',
                                    'filter' => 'permission:podcast$1.episodes.manage-comments',
                                ],
                            );
                            $routes->post(
                                'delete',
                                'EpisodeController::commentDeleteAction/$1/$2',
                                [
                                    'as'     => 'comment-attempt-delete',
                                    'filter' => 'permission:podcast$1.episodes.manage-comments',
                                ],
                            );
                        });
                    });
                });
                // Podcast notifications
                $routes->group('notifications', static function ($routes): void {
                    $routes->get('/', 'NotificationController::list/$1', [
                        'as'     => 'notification-list',
                        'filter' => 'permission:podcast$1.manage-notifications',
                    ]);
                    $routes->get('(:num)/mark-as-read', 'NotificationController::markAsReadAction/$1/$2', [
                        'as'     => 'notification-mark-as-read',
                        'filter' => 'permission:podcast$1.manage-notifications',
                    ]);
                    $routes->get('mark-all-as-read', 'NotificationController::markAllAsReadAction/$1', [
                        'as'     => 'notification-mark-all-as-read',
                        'filter' => 'permission:podcast$1.manage-notifications',
                    ]);
                });
            });
        });
        // Instance wide Fediverse config
        $routes->group('fediverse', static function ($routes): void {
            $routes->get('/', 'FediverseController::dashboard', [
                'as' => 'fediverse-dashboard',
            ]);
            $routes->get(
                'blocked-actors',
                'FediverseController::blockedActorsView',
                [
                    'as'     => 'fediverse-blocked-actors',
                    'filter' => 'permission:fediverse.manage-blocks',
                ],
            );
            $routes->get(
                'blocked-domains',
                'FediverseController::blockedDomainsView',
                [
                    'as'     => 'fediverse-blocked-domains',
                    'filter' => 'permission:fediverse.manage-blocks',
                ],
            );
        });
        // Pages
        $routes->group('pages', static function ($routes): void {
            $routes->get('/', 'PageController::list', [
                'as'     => 'page-list',
                'filter' => 'permission:pages.manage',
            ]);
            $routes->get('new', 'PageController::createView', [
                'as'     => 'page-create',
                'filter' => 'permission:pages.manage',
            ]);
            $routes->post('new', 'PageController::createAction', [
                'filter' => 'permission:pages.manage',
            ]);
            $routes->group('(:num)', static function ($routes): void {
                $routes->get('/', 'PageController::view/$1', [
                    'as' => 'page-view',
                ]);
                $routes->get('edit', 'PageController::editView/$1', [
                    'as'     => 'page-edit',
                    'filter' => 'permission:pages.manage',
                ]);
                $routes->post('edit', 'PageController::editAction/$1', [
                    'filter' => 'permission:pages.manage',
                ]);
                $routes->get('delete', 'PageController::deleteAction/$1', [
                    'as'     => 'page-delete',
                    'filter' => 'permission:pages.manage',
                ]);
            });
        });

        $routes->get('about', 'AboutController', [
            'as'     => 'admin-about',
            'filter' => 'permission:admin.settings',
        ]);

        $routes->post('update', 'AboutController::updateAction', [
            'as'     => 'update',
            'filter' => 'permission:admin.settings',
        ]);
    },
);
