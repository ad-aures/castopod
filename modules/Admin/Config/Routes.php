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
    config(Admin::class)->gateway,
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
            $routes->post('instance', 'SettingsController::attemptInstanceEdit', [
                'as'     => 'settings-instance',
                'filter' => 'permission:admin.settings',
            ]);
            $routes->get('instance-delete-icon', 'SettingsController::deleteIcon', [
                'as'     => 'settings-instance-delete-icon',
                'filter' => 'permission:admin.settings',
            ]);
            $routes->post('instance-images-regenerate', 'SettingsController::regenerateImages', [
                'as'     => 'settings-images-regenerate',
                'filter' => 'permission:admin.settings',
            ]);
            $routes->post('instance-housekeeping-run', 'SettingsController::runHousekeeping', [
                'as'     => 'settings-housekeeping-run',
                'filter' => 'permission:admin.settings',
            ]);
            $routes->get('theme', 'SettingsController::theme', [
                'as'     => 'settings-theme',
                'filter' => 'permission:admin.settings',
            ]);
            $routes->post('theme', 'SettingsController::attemptSetInstanceTheme', [
                'as'     => 'settings-theme',
                'filter' => 'permission:admin.settings',
            ]);
        });
        $routes->group('persons', static function ($routes): void {
            $routes->get('/', 'PersonController', [
                'as'     => 'person-list',
                'filter' => 'permission:persons.manage',
            ]);
            $routes->get('new', 'PersonController::create', [
                'as'     => 'person-create',
                'filter' => 'permission:persons.manage',
            ]);
            $routes->post('new', 'PersonController::attemptCreate', [
                'filter' => 'permission:persons.manage',
            ]);
            $routes->group('(:num)', static function ($routes): void {
                $routes->get('/', 'PersonController::view/$1', [
                    'as'     => 'person-view',
                    'filter' => 'permission:persons.manage',
                ]);
                $routes->get('edit', 'PersonController::edit/$1', [
                    'as'     => 'person-edit',
                    'filter' => 'permission:persons.manage',
                ]);
                $routes->post('edit', 'PersonController::attemptEdit/$1', [
                    'filter' => 'permission:persons.manage',
                ]);
                $routes->add('delete', 'PersonController::delete/$1', [
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
            $routes->get('new', 'PodcastController::create', [
                'as'     => 'podcast-create',
                'filter' => 'permission:podcasts.create',
            ]);
            $routes->post('new', 'PodcastController::attemptCreate', [
                'filter' => 'permission:podcasts.create',
            ]);
            // Podcast
            // Use ids in admin area to help permission and group lookups
            $routes->group('(:num)', static function ($routes): void {
                $routes->get('/', 'PodcastController::view/$1', [
                    'as'     => 'podcast-view',
                    'filter' => 'permission:podcast#.view',
                ]);
                $routes->get('edit', 'PodcastController::edit/$1', [
                    'as'     => 'podcast-edit',
                    'filter' => 'permission:podcast#.edit',
                ]);
                $routes->post('edit', 'PodcastController::attemptEdit/$1', [
                    'filter' => 'permission:podcast#.edit',
                ]);
                $routes->get(
                    'publish',
                    'PodcastController::publish/$1',
                    [
                        'as'     => 'podcast-publish',
                        'filter' => 'permission:podcast#.manage-publications',
                    ],
                );
                $routes->post(
                    'publish',
                    'PodcastController::attemptPublish/$1',
                    [
                        'filter' => 'permission:podcast#.manage-publications',
                    ],
                );
                $routes->get(
                    'publish-edit',
                    'PodcastController::publishEdit/$1',
                    [
                        'as'     => 'podcast-publish_edit',
                        'filter' => 'permission:podcast#.manage-publications',
                    ],
                );
                $routes->post(
                    'publish-edit',
                    'PodcastController::attemptPublishEdit/$1',
                    [
                        'filter' => 'permission:podcast#.manage-publications',
                    ],
                );
                $routes->get(
                    'publish-cancel',
                    'PodcastController::publishCancel/$1',
                    [
                        'as'     => 'podcast-publish-cancel',
                        'filter' => 'permission:podcast#.manage-publications',
                    ],
                );
                $routes->get('edit/delete-banner', 'PodcastController::deleteBanner/$1', [
                    'as'     => 'podcast-banner-delete',
                    'filter' => 'permission:podcast#.edit',
                ]);
                $routes->get('delete', 'PodcastController::delete/$1', [
                    'as'     => 'podcast-delete',
                    'filter' => 'permission:podcast#.delete',
                ]);
                $routes->post('delete', 'PodcastController::attemptDelete/$1', [
                    'filter' => 'permission:podcast#.delete',
                ]);
                $routes->group('persons', static function ($routes): void {
                    $routes->get('/', 'PodcastPersonController::index/$1', [
                        'as'     => 'podcast-persons-manage',
                        'filter' => 'permission:podcast#.manage-persons',
                    ]);
                    $routes->post(
                        '/',
                        'PodcastPersonController::attemptCreate/$1',
                        [
                            'filter' => 'permission:podcast#.manage-persons',
                        ],
                    );
                    $routes->get(
                        '(:num)/remove',
                        'PodcastPersonController::remove/$1/$2',
                        [
                            'as'     => 'podcast-person-remove',
                            'filter' => 'permission:podcast#.manage-persons',
                        ],
                    );
                });
                $routes->group('analytics', static function ($routes): void {
                    $routes->get('/', 'PodcastController::viewAnalytics/$1', [
                        'as'     => 'podcast-analytics',
                        'filter' => 'permission:podcast#.view',
                    ]);
                    $routes->get(
                        'webpages',
                        'PodcastController::viewAnalyticsWebpages/$1',
                        [
                            'as'     => 'podcast-analytics-webpages',
                            'filter' => 'permission:podcast#.view',
                        ],
                    );
                    $routes->get(
                        'locations',
                        'PodcastController::viewAnalyticsLocations/$1',
                        [
                            'as'     => 'podcast-analytics-locations',
                            'filter' => 'permission:podcast#.view',
                        ],
                    );
                    $routes->get(
                        'unique-listeners',
                        'PodcastController::viewAnalyticsUniqueListeners/$1',
                        [
                            'as'     => 'podcast-analytics-unique-listeners',
                            'filter' => 'permission:podcast#.view',
                        ],
                    );
                    $routes->get(
                        'listening-time',
                        'PodcastController::viewAnalyticsListeningTime/$1',
                        [
                            'as'     => 'podcast-analytics-listening-time',
                            'filter' => 'permission:podcast#.view',
                        ],
                    );
                    $routes->get(
                        'time-periods',
                        'PodcastController::viewAnalyticsTimePeriods/$1',
                        [
                            'as'     => 'podcast-analytics-time-periods',
                            'filter' => 'permission:podcast#.view',
                        ],
                    );
                    $routes->get(
                        'players',
                        'PodcastController::viewAnalyticsPlayers/$1',
                        [
                            'as'     => 'podcast-analytics-players',
                            'filter' => 'permission:podcast#.view',
                        ],
                    );
                });
                // Podcast episodes
                $routes->group('episodes', static function ($routes): void {
                    $routes->get('/', 'EpisodeController::list/$1', [
                        'as'     => 'episode-list',
                        'filter' => 'permission:podcast#.episodes.view',
                    ]);
                    $routes->get('new', 'EpisodeController::create/$1', [
                        'as'     => 'episode-create',
                        'filter' => 'permission:podcast#.episodes.create',
                    ]);
                    $routes->post(
                        'new',
                        'EpisodeController::attemptCreate/$1',
                        [
                            'filter' => 'permission:podcast#.episodes.create',
                        ],
                    );
                    // Episode
                    $routes->group('(:num)', static function ($routes): void {
                        $routes->get('/', 'EpisodeController::view/$1/$2', [
                            'as'     => 'episode-view',
                            'filter' => 'permission:podcast#.episodes.view',
                        ]);
                        $routes->get('edit', 'EpisodeController::edit/$1/$2', [
                            'as'     => 'episode-edit',
                            'filter' => 'permission:podcast#.episodes.edit',
                        ]);
                        $routes->post(
                            'edit',
                            'EpisodeController::attemptEdit/$1/$2',
                            [
                                'filter' => 'permission:podcast#.episodes.edit',
                            ],
                        );
                        $routes->get(
                            'publish',
                            'EpisodeController::publish/$1/$2',
                            [
                                'as'     => 'episode-publish',
                                'filter' => 'permission:podcast#.episodes.manage-publications',
                            ],
                        );
                        $routes->post(
                            'publish',
                            'EpisodeController::attemptPublish/$1/$2',
                            [
                                'filter' => 'permission:podcast#.episodes.manage-publications',
                            ],
                        );
                        $routes->get(
                            'publish-edit',
                            'EpisodeController::publishEdit/$1/$2',
                            [
                                'as'     => 'episode-publish_edit',
                                'filter' => 'permission:podcast#.episodes.manage-publications',
                            ],
                        );
                        $routes->post(
                            'publish-edit',
                            'EpisodeController::attemptPublishEdit/$1/$2',
                            [
                                'filter' => 'permission:podcast#.episodes.manage-publications',
                            ],
                        );
                        $routes->get(
                            'publish-cancel',
                            'EpisodeController::publishCancel/$1/$2',
                            [
                                'as'     => 'episode-publish-cancel',
                                'filter' => 'permission:podcast#.episodes.manage-publications',
                            ],
                        );
                        $routes->get(
                            'publish-date-edit',
                            'EpisodeController::publishDateEdit/$1/$2',
                            [
                                'as'     => 'episode-publish_date_edit',
                                'filter' => 'permission:podcast#.episodes.manage-publications',
                            ],
                        );
                        $routes->post(
                            'publish-date-edit',
                            'EpisodeController::attemptPublishDateEdit/$1/$2',
                            [
                                'filter' => 'permission:podcast#.episodes.manage-publications',
                            ],
                        );
                        $routes->get(
                            'unpublish',
                            'EpisodeController::unpublish/$1/$2',
                            [
                                'as'     => 'episode-unpublish',
                                'filter' => 'permission:podcast#.episodes.manage-publications',
                            ],
                        );
                        $routes->post(
                            'unpublish',
                            'EpisodeController::attemptUnpublish/$1/$2',
                            [
                                'filter' => 'permission:podcast#.episodes.manage-publications',
                            ],
                        );
                        $routes->get(
                            'delete',
                            'EpisodeController::delete/$1/$2',
                            [
                                'as'     => 'episode-delete',
                                'filter' => 'permission:podcast#.episodes.delete',
                            ],
                        );
                        $routes->post(
                            'delete',
                            'EpisodeController::attemptDelete/$1/$2',
                            [
                                'filter' => 'permission:podcast#.episodes.delete',
                            ],
                        );
                        $routes->get(
                            'transcript-delete',
                            'EpisodeController::transcriptDelete/$1/$2',
                            [
                                'as'     => 'transcript-delete',
                                'filter' => 'permission:podcast#.episodes.edit',
                            ],
                        );
                        $routes->get(
                            'chapters-delete',
                            'EpisodeController::chaptersDelete/$1/$2',
                            [
                                'as'     => 'chapters-delete',
                                'filter' => 'permission:podcast#.episodes.edit',
                            ],
                        );
                        $routes->get(
                            'soundbites',
                            'SoundbiteController::list/$1/$2',
                            [
                                'as'     => 'soundbites-list',
                                'filter' => 'permission:podcast#.episodes.manage-clips',
                            ],
                        );
                        $routes->get(
                            'soundbites/new',
                            'SoundbiteController::create/$1/$2',
                            [
                                'as'     => 'soundbites-create',
                                'filter' => 'permission:podcast#.episodes.manage-clips',
                            ],
                        );
                        $routes->post(
                            'soundbites/new',
                            'SoundbiteController::attemptCreate/$1/$2',
                            [
                                'as'     => 'soundbites-create',
                                'filter' => 'permission:podcast#.episodes.manage-clips',
                            ],
                        );
                        $routes->get(
                            'soundbites/(:num)/delete',
                            'SoundbiteController::delete/$1/$2/$3',
                            [
                                'as'     => 'soundbites-delete',
                                'filter' => 'permission:podcast#.episodes.manage-clips',
                            ],
                        );
                        $routes->get(
                            'video-clips',
                            'VideoClipsController::list/$1/$2',
                            [
                                'as'     => 'video-clips-list',
                                'filter' => 'permission:podcast#.episodes.manage-clips',
                            ],
                        );
                        $routes->get(
                            'video-clips/new',
                            'VideoClipsController::create/$1/$2',
                            [
                                'as'     => 'video-clips-create',
                                'filter' => 'permission:podcast#.episodes.manage-clips',
                            ],
                        );
                        $routes->post(
                            'video-clips/new',
                            'VideoClipsController::attemptCreate/$1/$2',
                            [
                                'as'     => 'video-clips-create',
                                'filter' => 'permission:podcast#.episodes.manage-clips',
                            ],
                        );
                        $routes->get(
                            'video-clips/(:num)',
                            'VideoClipsController::view/$1/$2/$3',
                            [
                                'as'     => 'video-clip',
                                'filter' => 'permission:podcast#.episodes.manage-clips',
                            ],
                        );
                        $routes->get(
                            'video-clips/(:num)/retry',
                            'VideoClipsController::retry/$1/$2/$3',
                            [
                                'as'     => 'video-clip-retry',
                                'filter' => 'permission:podcast#.episodes.manage-clips',
                            ],
                        );
                        $routes->get(
                            'video-clips/(:num)/delete',
                            'VideoClipsController::delete/$1/$2/$3',
                            [
                                'as'     => 'video-clip-delete',
                                'filter' => 'permission:podcast#.episodes.manage-clips',
                            ],
                        );
                        $routes->get(
                            'embed',
                            'EpisodeController::embed/$1/$2',
                            [
                                'as'     => 'embed-add',
                                'filter' => 'permission:podcast#.episodes.edit',
                            ],
                        );
                        $routes->group('persons', static function ($routes): void {
                            $routes->get('/', 'EpisodePersonController::index/$1/$2', [
                                'as'     => 'episode-persons-manage',
                                'filter' => 'permission:podcast#.episodes.manage-persons',
                            ]);
                            $routes->post(
                                '/',
                                'EpisodePersonController::attemptCreate/$1/$2',
                                [
                                    'filter' => 'permission:podcast#.episodes.manage-persons',
                                ],
                            );
                            $routes->get(
                                '(:num)/remove',
                                'EpisodePersonController::remove/$1/$2/$3',
                                [
                                    'as'     => 'episode-person-remove',
                                    'filter' => 'permission:podcast#.episodes.manage-persons',
                                ],
                            );
                        });
                        $routes->group('comments', static function ($routes): void {
                            $routes->post(
                                'new',
                                'EpisodeController::attemptCommentCreate/$1/$2',
                                [
                                    'as'     => 'comment-attempt-create',
                                    'filter' => 'permission:podcast#.episodes.manage-comments',
                                ]
                            );
                            $routes->post(
                                '(:uuid)/reply',
                                'EpisodeController::attemptCommentReply/$1/$2/$3',
                                [
                                    'as'     => 'comment-attempt-reply',
                                    'filter' => 'permission:podcast#.episodes.manage-comments',
                                ]
                            );
                            $routes->post(
                                'delete',
                                'EpisodeController::attemptCommentDelete/$1/$2',
                                [
                                    'as'     => 'comment-attempt-delete',
                                    'filter' => 'permission:podcast#.episodes.manage-comments',
                                ]
                            );
                        });
                    });
                });
                $routes->group('platforms', static function ($routes): void {
                    $routes->get(
                        '/',
                        'PodcastPlatformController::platforms/$1/podcasting',
                        [
                            'as'     => 'platforms-podcasting',
                            'filter' => 'permission:podcast#.manage-platforms',
                        ],
                    );
                    $routes->get(
                        'social',
                        'PodcastPlatformController::platforms/$1/social',
                        [
                            'as'     => 'platforms-social',
                            'filter' => 'permission:podcast#.manage-platforms',
                        ],
                    );
                    $routes->get(
                        'funding',
                        'PodcastPlatformController::platforms/$1/funding',
                        [
                            'as'     => 'platforms-funding',
                            'filter' => 'permission:podcast#.manage-platforms',
                        ],
                    );
                    $routes->post(
                        'save/(:platformType)',
                        'PodcastPlatformController::attemptPlatformsUpdate/$1/$2',
                        [
                            'as'     => 'platforms-save',
                            'filter' => 'permission:podcast#.manage-platforms',
                        ],
                    );
                    $routes->get(
                        '(:slug)/podcast-platform-remove',
                        'PodcastPlatformController::removePodcastPlatform/$1/$2',
                        [
                            'as'     => 'podcast-platform-remove',
                            'filter' => 'permission:podcast#.manage-platforms',
                        ],
                    );
                });
                // Podcast notifications
                $routes->group('notifications', static function ($routes): void {
                    $routes->get('/', 'NotificationController::list/$1', [
                        'as'     => 'notification-list',
                        'filter' => 'permission:podcast#.manage-notifications',
                    ]);
                    $routes->get('(:num)/mark-as-read', 'NotificationController::markAsRead/$1/$2', [
                        'as'     => 'notification-mark-as-read',
                        'filter' => 'permission:podcast#.manage-notifications',
                    ]);
                    $routes->get('mark-all-as-read', 'NotificationController::markAllAsRead/$1', [
                        'as'     => 'notification-mark-all-as-read',
                        'filter' => 'permission:podcast#.manage-notifications',
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
                'FediverseController::blockedActors',
                [
                    'as'     => 'fediverse-blocked-actors',
                    'filter' => 'permission:fediverse.manage-blocks',
                ],
            );
            $routes->get(
                'blocked-domains',
                'FediverseController::blockedDomains',
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
            $routes->get('new', 'PageController::create', [
                'as'     => 'page-create',
                'filter' => 'permission:pages.manage',
            ]);
            $routes->post('new', 'PageController::attemptCreate', [
                'filter' => 'permission:pages.manage',
            ]);
            $routes->group('(:num)', static function ($routes): void {
                $routes->get('/', 'PageController::view/$1', [
                    'as' => 'page-view',
                ]);
                $routes->get('edit', 'PageController::edit/$1', [
                    'as'     => 'page-edit',
                    'filter' => 'permission:pages.manage',
                ]);
                $routes->post('edit', 'PageController::attemptEdit/$1', [
                    'filter' => 'permission:pages.manage',
                ]);
                $routes->get('delete', 'PageController::delete/$1', [
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
