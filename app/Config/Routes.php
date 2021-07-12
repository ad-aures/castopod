<?php

declare(strict_types=1);

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Placeholder definitions
 * --------------------------------------------------------------------
 */

$routes->addPlaceholder('podcastName', '[a-zA-Z0-9\_]{1,32}');
$routes->addPlaceholder('slug', '[a-zA-Z0-9\-]{1,191}');
$routes->addPlaceholder('base64', '[A-Za-z0-9\.\_]+\-{0,2}');
$routes->addPlaceholder('platformType', '\bpodcasting|\bsocial|\bfunding');
$routes->addPlaceholder('statusAction', '\bfavourite|\breblog|\breply');
$routes->addPlaceholder('embeddablePlayerTheme', '\blight|\bdark|\blight-transparent|\bdark-transparent');
$routes->addPlaceholder(
    'uuid',
    '[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-4[0-9A-Fa-f]{3}-[89ABab][0-9A-Fa-f]{3}-[0-9A-Fa-f]{12}',
);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index', [
    'as' => 'home',
]);

// Install Wizard route
$routes->group(config('App')->installGateway, function ($routes): void {
    $routes->get('/', 'InstallController', [
        'as' => 'install',
    ]);
    $routes->post('instance-config', 'InstallController::attemptInstanceConfig', [
        'as' => 'instance-config',
    ]);
    $routes->post('database-config', 'InstallController::attemptDatabaseConfig', [
        'as' => 'database-config',
    ]);
    $routes->post('cache-config', 'InstallController::attemptCacheConfig', [
        'as' => 'cache-config',
    ]);
    $routes->post(
        'create-superadmin',
        'InstallController::attemptCreateSuperAdmin',
        [
            'as' => 'create-superadmin',
        ],
    );
});

$routes->get('.well-known/platforms', 'Platform');

// Admin area
$routes->group(
    config('App')
        ->adminGateway,
    [
        'namespace' => 'App\Controllers\Admin',
    ],
    function ($routes): void {
        $routes->get('/', 'HomeController', [
            'as' => 'admin',
        ]);

        $routes->group('persons', function ($routes): void {
            $routes->get('/', 'PersonController', [
                'as' => 'person-list',
                'filter' => 'permission:person-list',
            ]);
            $routes->get('new', 'PersonController::create', [
                'as' => 'person-create',
                'filter' => 'permission:person-create',
            ]);
            $routes->post('new', 'PersonController::attemptCreate', [
                'filter' => 'permission:person-create',
            ]);
            $routes->group('(:num)', function ($routes): void {
                $routes->get('/', 'PersonController::view/$1', [
                    'as' => 'person-view',
                    'filter' => 'permission:person-view',
                ]);
                $routes->get('edit', 'PersonController::edit/$1', [
                    'as' => 'person-edit',
                    'filter' => 'permission:person-edit',
                ]);
                $routes->post('edit', 'PersonController::attemptEdit/$1', [
                    'filter' => 'permission:person-edit',
                ]);
                $routes->add('delete', 'PersonController::delete/$1', [
                    'as' => 'person-delete',
                    'filter' => 'permission:person-delete',
                ]);
            });
        });

        // Podcasts
        $routes->group('podcasts', function ($routes): void {
            $routes->get('/', 'PodcastController::list', [
                'as' => 'podcast-list',
            ]);
            $routes->get('new', 'PodcastController::create', [
                'as' => 'podcast-create',
                'filter' => 'permission:podcasts-create',
            ]);
            $routes->post('new', 'PodcastController::attemptCreate', [
                'filter' => 'permission:podcasts-create',
            ]);
            $routes->get('import', 'PodcastImportController', [
                'as' => 'podcast-import',
                'filter' => 'permission:podcasts-import',
            ]);
            $routes->post('import', 'PodcastImportController::attemptImport', [
                'filter' => 'permission:podcasts-import',
            ]);

            // Podcast
            // Use ids in admin area to help permission and group lookups
            $routes->group('(:num)', function ($routes): void {
                $routes->get('/', 'PodcastController::view/$1', [
                    'as' => 'podcast-view',
                    'filter' => 'permission:podcasts-view,podcast-view',
                ]);
                $routes->get('edit', 'PodcastController::edit/$1', [
                    'as' => 'podcast-edit',
                    'filter' => 'permission:podcast-edit',
                ]);
                $routes->post('edit', 'PodcastController::attemptEdit/$1', [
                    'filter' => 'permission:podcast-edit',
                ]);
                $routes->get('delete', 'PodcastController::delete/$1', [
                    'as' => 'podcast-delete',
                    'filter' => 'permission:podcasts-delete',
                ]);

                $routes->group('persons', function ($routes): void {
                    $routes->get('/', 'PodcastPersonController/$1', [
                        'as' => 'podcast-person-manage',
                        'filter' => 'permission:podcast-edit',
                    ]);
                    $routes->post(
                        '/',
                        'PodcastPersonController::attemptAdd/$1',
                        [
                            'filter' => 'permission:podcast-edit',
                        ],
                    );

                    $routes->get(
                        '(:num)/remove',
                        'PodcastPersonController::remove/$1/$2',
                        [
                            'as' => 'podcast-person-remove',
                            'filter' => 'permission:podcast-edit',
                        ],
                    );
                });

                $routes->group('analytics', function ($routes): void {
                    $routes->get('/', 'PodcastController::viewAnalytics/$1', [
                        'as' => 'podcast-analytics',
                        'filter' => 'permission:podcasts-view,podcast-view',
                    ]);
                    $routes->get(
                        'webpages',
                        'PodcastController::viewAnalyticsWebpages/$1',
                        [
                            'as' => 'podcast-analytics-webpages',
                            'filter' => 'permission:podcasts-view,podcast-view',
                        ],
                    );
                    $routes->get(
                        'locations',
                        'PodcastController::viewAnalyticsLocations/$1',
                        [
                            'as' => 'podcast-analytics-locations',
                            'filter' => 'permission:podcasts-view,podcast-view',
                        ],
                    );
                    $routes->get(
                        'unique-listeners',
                        'PodcastController::viewAnalyticsUniqueListeners/$1',
                        [
                            'as' => 'podcast-analytics-unique-listeners',
                            'filter' => 'permission:podcasts-view,podcast-view',
                        ],
                    );
                    $routes->get(
                        'listening-time',
                        'PodcastController::viewAnalyticsListeningTime/$1',
                        [
                            'as' => 'podcast-analytics-listening-time',
                            'filter' => 'permission:podcasts-view,podcast-view',
                        ],
                    );
                    $routes->get(
                        'time-periods',
                        'PodcastController::viewAnalyticsTimePeriods/$1',
                        [
                            'as' => 'podcast-analytics-time-periods',
                            'filter' => 'permission:podcasts-view,podcast-view',
                        ],
                    );
                    $routes->get(
                        'players',
                        'PodcastController::viewAnalyticsPlayers/$1',
                        [
                            'as' => 'podcast-analytics-players',
                            'filter' => 'permission:podcasts-view,podcast-view',
                        ],
                    );
                });

                // Podcast episodes
                $routes->group('episodes', function ($routes): void {
                    $routes->get('/', 'EpisodeController::list/$1', [
                        'as' => 'episode-list',
                        'filter' =>
                            'permission:episodes-list,podcast_episodes-list',
                    ]);
                    $routes->get('new', 'EpisodeController::create/$1', [
                        'as' => 'episode-create',
                        'filter' => 'permission:podcast_episodes-create',
                    ]);
                    $routes->post(
                        'new',
                        'EpisodeController::attemptCreate/$1',
                        [
                            'filter' => 'permission:podcast_episodes-create',
                        ],
                    );

                    // Episode
                    $routes->group('(:num)', function ($routes): void {
                        $routes->get('/', 'EpisodeController::view/$1/$2', [
                            'as' => 'episode-view',
                            'filter' =>
                                'permission:episodes-view,podcast_episodes-view',
                        ]);
                        $routes->get('edit', 'EpisodeController::edit/$1/$2', [
                            'as' => 'episode-edit',
                            'filter' => 'permission:podcast_episodes-edit',
                        ]);
                        $routes->post(
                            'edit',
                            'EpisodeController::attemptEdit/$1/$2',
                            [
                                'filter' => 'permission:podcast_episodes-edit',
                            ],
                        );
                        $routes->get(
                            'publish',
                            'EpisodeController::publish/$1/$2',
                            [
                                'as' => 'episode-publish',
                                'filter' =>
                                    'permission:podcast-manage_publications',
                            ],
                        );
                        $routes->post(
                            'publish',
                            'EpisodeController::attemptPublish/$1/$2',
                            [
                                'filter' =>
                                    'permission:podcast-manage_publications',
                            ],
                        );
                        $routes->get(
                            'publish-edit',
                            'EpisodeController::publishEdit/$1/$2',
                            [
                                'as' => 'episode-publish_edit',
                                'filter' =>
                                    'permission:podcast-manage_publications',
                            ],
                        );
                        $routes->post(
                            'publish-edit',
                            'EpisodeController::attemptPublishEdit/$1/$2',
                            [
                                'filter' =>
                                    'permission:podcast-manage_publications',
                            ],
                        );
                        $routes->get(
                            'publish-cancel',
                            'EpisodeController::publishCancel/$1/$2',
                            [
                                'as' => 'episode-publish-cancel',
                                'filter' =>
                                    'permission:podcast-manage_publications',
                            ],
                        );
                        $routes->get(
                            'unpublish',
                            'EpisodeController::unpublish/$1/$2',
                            [
                                'as' => 'episode-unpublish',
                                'filter' =>
                                    'permission:podcast-manage_publications',
                            ],
                        );
                        $routes->post(
                            'unpublish',
                            'EpisodeController::attemptUnpublish/$1/$2',
                            [
                                'filter' =>
                                    'permission:podcast-manage_publications',
                            ],
                        );
                        $routes->get(
                            'delete',
                            'EpisodeController::delete/$1/$2',
                            [
                                'as' => 'episode-delete',
                                'filter' =>
                                    'permission:podcast_episodes-delete',
                            ],
                        );
                        $routes->get(
                            'transcript-delete',
                            'EpisodeController::transcriptDelete/$1/$2',
                            [
                                'as' => 'transcript-delete',
                                'filter' => 'permission:podcast_episodes-edit',
                            ],
                        );
                        $routes->get(
                            'chapters-delete',
                            'EpisodeController::chaptersDelete/$1/$2',
                            [
                                'as' => 'chapters-delete',
                                'filter' => 'permission:podcast_episodes-edit',
                            ],
                        );
                        $routes->get(
                            'soundbites',
                            'EpisodeController::soundbitesEdit/$1/$2',
                            [
                                'as' => 'soundbites-edit',
                                'filter' => 'permission:podcast_episodes-edit',
                            ],
                        );
                        $routes->post(
                            'soundbites',
                            'EpisodeController::soundbitesAttemptEdit/$1/$2',
                            [
                                'filter' => 'permission:podcast_episodes-edit',
                            ],
                        );
                        $routes->get(
                            'soundbites/(:num)/delete',
                            'EpisodeController::soundbiteDelete/$1/$2/$3',
                            [
                                'as' => 'soundbite-delete',
                                'filter' => 'permission:podcast_episodes-edit',
                            ],
                        );
                        $routes->get(
                            'embeddable-player',
                            'EpisodeController::embeddablePlayer/$1/$2',
                            [
                                'as' => 'embeddable-player-add',
                                'filter' => 'permission:podcast_episodes-edit',
                            ],
                        );

                        $routes->group('persons', function ($routes): void {
                            $routes->get('/', 'EpisodePersonController/$1/$2', [
                                'as' => 'episode-person-manage',
                                'filter' => 'permission:podcast_episodes-edit',
                            ]);
                            $routes->post(
                                '/',
                                'EpisodePersonController::attemptAdd/$1/$2',
                                [
                                    'filter' =>
                                        'permission:podcast_episodes-edit',
                                ],
                            );
                            $routes->get(
                                '(:num)/remove',
                                'EpisodePersonController::remove/$1/$2/$3',
                                [
                                    'as' => 'episode-person-remove',
                                    'filter' =>
                                        'permission:podcast_episodes-edit',
                                ],
                            );
                        });
                    });
                });

                // Podcast contributors
                $routes->group('contributors', function ($routes): void {
                    $routes->get('/', 'ContributorController::list/$1', [
                        'as' => 'contributor-list',
                        'filter' =>
                            'permission:podcasts-view,podcast-manage_contributors',
                    ]);
                    $routes->get('add', 'ContributorController::add/$1', [
                        'as' => 'contributor-add',
                        'filter' => 'permission:podcast-manage_contributors',
                    ]);
                    $routes->post(
                        'add',
                        'ContributorController::attemptAdd/$1',
                        [
                            'filter' =>
                                'permission:podcast-manage_contributors',
                        ],
                    );

                    // Contributor
                    $routes->group('(:num)', function ($routes): void {
                        $routes->get('/', 'ContributorController::view/$1/$2', [
                            'as' => 'contributor-view',
                            'filter' =>
                                'permission:podcast-manage_contributors',
                        ]);
                        $routes->get(
                            'edit',
                            'ContributorController::edit/$1/$2',
                            [
                                'as' => 'contributor-edit',
                                'filter' =>
                                    'permission:podcast-manage_contributors',
                            ],
                        );
                        $routes->post(
                            'edit',
                            'ContributorController::attemptEdit/$1/$2',
                            [
                                'filter' =>
                                    'permission:podcast-manage_contributors',
                            ],
                        );
                        $routes->get(
                            'remove',
                            'ContributorController::remove/$1/$2',
                            [
                                'as' => 'contributor-remove',
                                'filter' =>
                                    'permission:podcast-manage_contributors',
                            ],
                        );
                    });
                });

                $routes->group('platforms', function ($routes): void {
                    $routes->get(
                        '/',
                        'PodcastPlatformController::platforms/$1/podcasting',
                        [
                            'as' => 'platforms-podcasting',
                            'filter' => 'permission:podcast-manage_platforms',
                        ],
                    );
                    $routes->get(
                        'social',
                        'PodcastPlatformController::platforms/$1/social',
                        [
                            'as' => 'platforms-social',
                            'filter' => 'permission:podcast-manage_platforms',
                        ],
                    );
                    $routes->get(
                        'funding',
                        'PodcastPlatformController::platforms/$1/funding',
                        [
                            'as' => 'platforms-funding',
                            'filter' => 'permission:podcast-manage_platforms',
                        ],
                    );
                    $routes->post(
                        'save/(:platformType)',
                        'PodcastPlatformController::attemptPlatformsUpdate/$1/$2',
                        [
                            'as' => 'platforms-save',
                            'filter' => 'permission:podcast-manage_platforms',
                        ],
                    );
                    $routes->get(
                        '(:slug)/podcast-platform-remove',
                        'PodcastPlatformController::removePodcastPlatform/$1/$2',
                        [
                            'as' => 'podcast-platform-remove',
                            'filter' => 'permission:podcast-manage_platforms',
                        ],
                    );
                });
            });
        });

        // Instance wide Fediverse config
        $routes->group('fediverse', function ($routes): void {
            $routes->get('/', 'FediverseController::dashboard', [
                'as' => 'fediverse-dashboard',
            ]);
            $routes->get(
                'blocked-actors',
                'FediverseController::blockedActors',
                [
                    'as' => 'fediverse-blocked-actors',
                    'filter' => 'permission:fediverse-block_actors',
                ],
            );
            $routes->get(
                'blocked-domains',
                'FediverseController::blockedDomains',
                [
                    'as' => 'fediverse-blocked-domains',
                    'filter' => 'permission:fediverse-block_domains',
                ],
            );
        });

        // Pages
        $routes->group('pages', function ($routes): void {
            $routes->get('/', 'PageController::list', [
                'as' => 'page-list',
            ]);
            $routes->get('new', 'PageController::create', [
                'as' => 'page-create',
                'filter' => 'permission:pages-manage',
            ]);
            $routes->post('new', 'PageController::attemptCreate', [
                'filter' => 'permission:pages-manage',
            ]);

            $routes->group('(:num)', function ($routes): void {
                $routes->get('/', 'PageController::view/$1', [
                    'as' => 'page-view',
                ]);
                $routes->get('edit', 'PageController::edit/$1', [
                    'as' => 'page-edit',
                    'filter' => 'permission:pages-manage',
                ]);
                $routes->post('edit', 'PageController::attemptEdit/$1', [
                    'filter' => 'permission:pages-manage',
                ]);

                $routes->get('delete', 'PageController::delete/$1', [
                    'as' => 'page-delete',
                    'filter' => 'permission:pages-manage',
                ]);
            });
        });

        // Users
        $routes->group('users', function ($routes): void {
            $routes->get('/', 'UserController::list', [
                'as' => 'user-list',
                'filter' => 'permission:users-list',
            ]);
            $routes->get('new', 'UserController::create', [
                'as' => 'user-create',
                'filter' => 'permission:users-create',
            ]);
            $routes->post('new', 'UserController::attemptCreate', [
                'filter' => 'permission:users-create',
            ]);

            // User
            $routes->group('(:num)', function ($routes): void {
                $routes->get('/', 'UserController::view/$1', [
                    'as' => 'user-view',
                    'filter' => 'permission:users-view',
                ]);
                $routes->get('edit', 'UserController::edit/$1', [
                    'as' => 'user-edit',
                    'filter' => 'permission:users-manage_authorizations',
                ]);
                $routes->post('edit', 'UserController::attemptEdit/$1', [
                    'filter' => 'permission:users-manage_authorizations',
                ]);
                $routes->get('ban', 'UserController::ban/$1', [
                    'as' => 'user-ban',
                    'filter' => 'permission:users-manage_bans',
                ]);
                $routes->get('unban', 'UserController::unBan/$1', [
                    'as' => 'user-unban',
                    'filter' => 'permission:users-manage_bans',
                ]);
                $routes->get(
                    'force-pass-reset',
                    'UserController::forcePassReset/$1',
                    [
                        'as' => 'user-force_pass_reset',
                        'filter' => 'permission:users-force_pass_reset',
                    ],
                );
                $routes->get('delete', 'UserController::delete/$1', [
                    'as' => 'user-delete',
                    'filter' => 'permission:users-delete',
                ]);
            });
        });

        // My account
        $routes->group('my-account', function ($routes): void {
            $routes->get('/', 'MyAccountController', [
                'as' => 'my-account',
            ]);
            $routes->get(
                'change-password',
                'MyAccountController::changePassword/$1',
                [
                    'as' => 'change-password',
                ],
            );
            $routes->post('change-password', 'MyAccountController::attemptChange/$1');
        });
    },
);

/**
 * Overwriting Myth:auth routes file
 */
$routes->group(config('App')->authGateway, function ($routes): void {
    // Login/out
    $routes->get('login', 'AuthController::login', [
        'as' => 'login',
    ]);
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout', [
        'as' => 'logout',
    ]);

    // Registration
    $routes->get('register', 'AuthController::register', [
        'as' => 'register',
    ]);
    $routes->post('register', 'AuthController::attemptRegister');

    // Activation
    $routes->get('activate-account', 'AuthController::activateAccount', [
        'as' => 'activate-account',
    ]);
    $routes->get(
        'resend-activate-account',
        'AuthController::resendActivateAccount',
        [
            'as' => 'resend-activate-account',
        ],
    );

    // Forgot/Resets
    $routes->get('forgot', 'AuthController::forgotPassword', [
        'as' => 'forgot',
    ]);
    $routes->post('forgot', 'AuthController::attemptForgot');
    $routes->get('reset-password', 'AuthController::resetPassword', [
        'as' => 'reset-password',
    ]);
    $routes->post('reset-password', 'AuthController::attemptReset');
});

// Podcast's Public routes
$routes->group('@(:podcastName)', function ($routes): void {
    $routes->get('/', 'PodcastController::activity/$1', [
        'as' => 'podcast-activity',
    ]);
    // override default ActivityPub Library's actor route
    $routes->get('/', 'PodcastController::activity/$1', [
        'as' => 'actor',
        'alternate-content' => [
            'application/activity+json' => [
                'namespace' => 'ActivityPub\Controllers',
                'controller-method' => 'ActorController/$1',
            ],
            'application/podcast-activity+json' => [
                'namespace' => 'App\Controllers',
                'controller-method' => 'PodcastController::podcastActor/$1',
            ],
            'application/ld+json; profile="https://www.w3.org/ns/activitystreams' => [
                'namespace' => 'ActivityPub\Controllers',
                'controller-method' => 'ActorController/$1',
            ],
        ],
    ]);
    $routes->get('episodes', 'PodcastController::episodes/$1', [
        'as' => 'podcast-episodes',
        'alternate-content' => [
            'application/activity+json' => [
                'controller-method' => 'PodcastController::episodeCollection/$1',
            ],
            'application/podcast-activity+json' => [
                'controller-method' => 'PodcastController::episodeCollection/$1',
            ],
            'application/ld+json; profile="https://www.w3.org/ns/activitystreams' => [
                'controller-method' => 'PodcastController::episodeCollection/$1',
            ],
        ],
    ]);
    $routes->group('episodes/(:slug)', function ($routes): void {
        $routes->get('/', 'EpisodeController/$1/$2', [
            'as' => 'episode',
            'alternate-content' => [
                'application/activity+json' => [
                    'controller-method' => 'EpisodeController::episodeObject/$1/$2',
                ],
                'application/podcast-activity+json' => [
                    'controller-method' => 'EpisodeController::episodeObject/$1/$2',
                ],
                'application/ld+json; profile="https://www.w3.org/ns/activitystreams' => [
                    'controller-method' => 'EpisodeController::episodeObject/$1/$2',
                ],
            ],
        ]);
        $routes->get('comments', 'EpisodeController::comments/$1/$2', [
            'as' => 'episode-comments',
            'application/activity+json' => [
                'controller-method' => 'EpisodeController::comments/$1/$2',
            ],
            'application/podcast-activity+json' => [
                'controller-method' => 'EpisodeController::comments/$1/$2',
            ],
            'application/ld+json; profile="https://www.w3.org/ns/activitystreams' => [
                'controller-method' => 'EpisodeController::comments/$1/$2',
            ],
        ]);
        $routes->get('oembed.json', 'EpisodeController::oembedJSON/$1/$2', [
            'as' => 'episode-oembed-json',
        ]);
        $routes->get('oembed.xml', 'EpisodeController::oembedXML/$1/$2', [
            'as' => 'episode-oembed-xml',
        ]);
        $routes->group('embeddable-player', function ($routes): void {
            $routes->get('/', 'EpisodeController::embeddablePlayer/$1/$2', [
                'as' => 'embeddable-player',
            ]);
            $routes->get(
                '(:embeddablePlayerTheme)',
                'EpisodeController::embeddablePlayer/$1/$2/$3',
                [
                    'as' => 'embeddable-player-theme',
                ],
            );
        });
    });

    $routes->head('feed.xml', 'FeedController/$1', [
        'as' => 'podcast_feed',
    ]);
    $routes->get('feed.xml', 'FeedController/$1', [
        'as' => 'podcast_feed',
    ]);
});

// Other pages
$routes->get('/credits', 'CreditsController', [
    'as' => 'credits',
]);
$routes->get('/pages/(:slug)', 'PageController/$1', [
    'as' => 'page',
]);

// interacting as an actor
$routes->post('interact-as-actor', 'AuthController::attemptInteractAsActor', [
    'as' => 'interact-as-actor',
]);

/**
 * Overwriting ActivityPub routes file
 */
$routes->group('@(:podcastName)', function ($routes): void {
    $routes->post('statuses/new', 'StatusController::attemptCreate/$1', [
        'as' => 'status-attempt-create',
        'filter' => 'permission:podcast-manage_publications',
    ]);
    // Status
    $routes->group('statuses/(:uuid)', function ($routes): void {
        $routes->get('/', 'StatusController::view/$1/$2', [
            'as' => 'status',
            'alternate-content' => [
                'application/activity+json' => [
                    'namespace' => 'ActivityPub\Controllers',
                    'controller-method' => 'StatusController/$2',
                ],
                'application/ld+json; profile="https://www.w3.org/ns/activitystreams' => [
                    'namespace' => 'ActivityPub\Controllers',
                    'controller-method' => 'StatusController/$2',
                ],
            ],
        ]);
        $routes->get('replies', 'StatusController/$1/$2', [
            'as' => 'status-replies',
            'alternate-content' => [
                'application/activity+json' => [
                    'namespace' => 'ActivityPub\Controllers',
                    'controller-method' => 'StatusController::replies/$2',
                ],
                'application/ld+json; profile="https://www.w3.org/ns/activitystreams' => [
                    'namespace' => 'ActivityPub\Controllers',
                    'controller-method' => 'StatusController::replies/$2',
                ],
            ],
        ]);

        // Actions
        $routes->post('action', 'StatusController::attemptAction/$1/$2', [
            'as' => 'status-attempt-action',
            'filter' => 'permission:podcast-interact_as',
        ]);

        $routes->post(
            'block-actor',
            'StatusController::attemptBlockActor/$1/$2',
            [
                'as' => 'status-attempt-block-actor',
                'filter' => 'permission:fediverse-block_actors',
            ],
        );
        $routes->post(
            'block-domain',
            'StatusController::attemptBlockDomain/$1/$2',
            [
                'as' => 'status-attempt-block-domain',
                'filter' => 'permission:fediverse-block_domains',
            ],
        );
        $routes->post('delete', 'StatusController::attemptDelete/$1/$2', [
            'as' => 'status-attempt-delete',
            'filter' => 'permission:podcast-manage_publications',
        ]);

        $routes->get(
            'remote/(:statusAction)',
            'StatusController::remoteAction/$1/$2/$3',
            [
                'as' => 'status-remote-action',
            ],
        );
    });

    $routes->get('follow', 'ActorController::follow/$1', [
        'as' => 'follow',
    ]);
    $routes->get('outbox', 'ActorController::outbox/$1', [
        'as' => 'outbox',
        'filter' => 'activity-pub:verify-activitystream',
    ]);
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
