<?php

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
$routes->addPlaceholder('noteAction', '\bfavourite|\breblog|\breply');
$routes->addPlaceholder(
    'embeddablePlayerTheme',
    '\blight|\bdark|\blight-transparent|\bdark-transparent',
);
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
$routes->get('/', 'Home::index', ['as' => 'home']);

// Install Wizard route
$routes->group(config('App')->installGateway, function ($routes) {
    $routes->get('/', 'Install', ['as' => 'install']);
    $routes->post('instance-config', 'Install::attemptInstanceConfig', [
        'as' => 'instance-config',
    ]);
    $routes->post('database-config', 'Install::attemptDatabaseConfig', [
        'as' => 'database-config',
    ]);
    $routes->post('cache-config', 'Install::attemptCacheConfig', [
        'as' => 'cache-config',
    ]);
    $routes->post('create-superadmin', 'Install::attemptCreateSuperAdmin', [
        'as' => 'create-superadmin',
    ]);
});

$routes->get('.well-known/platforms', 'Platform');

// Admin area
$routes->group(
    config('App')->adminGateway,
    ['namespace' => 'App\Controllers\Admin'],
    function ($routes) {
        $routes->get('/', 'Home', [
            'as' => 'admin',
        ]);

        $routes->group('persons', function ($routes) {
            $routes->get('/', 'Person', [
                'as' => 'person-list',
                'filter' => 'permission:person-list',
            ]);
            $routes->get('new', 'Person::create', [
                'as' => 'person-create',
                'filter' => 'permission:person-create',
            ]);
            $routes->post('new', 'Person::attemptCreate', [
                'filter' => 'permission:person-create',
            ]);
            $routes->group('(:num)', function ($routes) {
                $routes->get('/', 'Person::view/$1', [
                    'as' => 'person-view',
                    'filter' => 'permission:person-view',
                ]);
                $routes->get('edit', 'Person::edit/$1', [
                    'as' => 'person-edit',
                    'filter' => 'permission:person-edit',
                ]);
                $routes->post('edit', 'Person::attemptEdit/$1', [
                    'filter' => 'permission:person-edit',
                ]);
                $routes->add('delete', 'Person::delete/$1', [
                    'as' => 'person-delete',
                    'filter' => 'permission:person-delete',
                ]);
            });
        });

        // Podcasts
        $routes->group('podcasts', function ($routes) {
            $routes->get('/', 'Podcast::list', [
                'as' => 'podcast-list',
            ]);
            $routes->get('new', 'Podcast::create', [
                'as' => 'podcast-create',
                'filter' => 'permission:podcasts-create',
            ]);
            $routes->post('new', 'Podcast::attemptCreate', [
                'filter' => 'permission:podcasts-create',
            ]);
            $routes->get('import', 'PodcastImport', [
                'as' => 'podcast-import',
                'filter' => 'permission:podcasts-import',
            ]);
            $routes->post('import', 'PodcastImport::attemptImport', [
                'filter' => 'permission:podcasts-import',
            ]);

            // Podcast
            // Use ids in admin area to help permission and group lookups
            $routes->group('(:num)', function ($routes) {
                $routes->get('/', 'Podcast::view/$1', [
                    'as' => 'podcast-view',
                    'filter' => 'permission:podcasts-view,podcast-view',
                ]);
                $routes->get('edit', 'Podcast::edit/$1', [
                    'as' => 'podcast-edit',
                    'filter' => 'permission:podcast-edit',
                ]);
                $routes->post('edit', 'Podcast::attemptEdit/$1', [
                    'filter' => 'permission:podcast-edit',
                ]);
                $routes->get('delete', 'Podcast::delete/$1', [
                    'as' => 'podcast-delete',
                    'filter' => 'permission:podcasts-delete',
                ]);

                $routes->group('persons', function ($routes) {
                    $routes->get('/', 'PodcastPerson/$1', [
                        'as' => 'podcast-person-manage',
                        'filter' => 'permission:podcast-edit',
                    ]);
                    $routes->post('/', 'PodcastPerson::attemptAdd/$1', [
                        'filter' => 'permission:podcast-edit',
                    ]);

                    $routes->get(
                        '(:num)/remove',
                        'PodcastPerson::remove/$1/$2',
                        [
                            'as' => 'podcast-person-remove',
                            'filter' => 'permission:podcast-edit',
                        ],
                    );
                });

                $routes->group('analytics', function ($routes) {
                    $routes->get('/', 'Podcast::viewAnalytics/$1', [
                        'as' => 'podcast-analytics',
                        'filter' => 'permission:podcasts-view,podcast-view',
                    ]);
                    $routes->get(
                        'webpages',
                        'Podcast::viewAnalyticsWebpages/$1',
                        [
                            'as' => 'podcast-analytics-webpages',
                            'filter' => 'permission:podcasts-view,podcast-view',
                        ],
                    );
                    $routes->get(
                        'locations',
                        'Podcast::viewAnalyticsLocations/$1',
                        [
                            'as' => 'podcast-analytics-locations',
                            'filter' => 'permission:podcasts-view,podcast-view',
                        ],
                    );
                    $routes->get(
                        'unique-listeners',
                        'Podcast::viewAnalyticsUniqueListeners/$1',
                        [
                            'as' => 'podcast-analytics-unique-listeners',
                            'filter' => 'permission:podcasts-view,podcast-view',
                        ],
                    );
                    $routes->get(
                        'listening-time',
                        'Podcast::viewAnalyticsListeningTime/$1',
                        [
                            'as' => 'podcast-analytics-listening-time',
                            'filter' => 'permission:podcasts-view,podcast-view',
                        ],
                    );
                    $routes->get(
                        'time-periods',
                        'Podcast::viewAnalyticsTimePeriods/$1',
                        [
                            'as' => 'podcast-analytics-time-periods',
                            'filter' => 'permission:podcasts-view,podcast-view',
                        ],
                    );
                    $routes->get(
                        'players',
                        'Podcast::viewAnalyticsPlayers/$1',
                        [
                            'as' => 'podcast-analytics-players',
                            'filter' => 'permission:podcasts-view,podcast-view',
                        ],
                    );
                });

                // Podcast episodes
                $routes->group('episodes', function ($routes) {
                    $routes->get('/', 'Episode::list/$1', [
                        'as' => 'episode-list',
                        'filter' =>
                            'permission:episodes-list,podcast_episodes-list',
                    ]);
                    $routes->get('new', 'Episode::create/$1', [
                        'as' => 'episode-create',
                        'filter' => 'permission:podcast_episodes-create',
                    ]);
                    $routes->post('new', 'Episode::attemptCreate/$1', [
                        'filter' => 'permission:podcast_episodes-create',
                    ]);

                    // Episode
                    $routes->group('(:num)', function ($routes) {
                        $routes->get('/', 'Episode::view/$1/$2', [
                            'as' => 'episode-view',
                            'filter' =>
                                'permission:episodes-view,podcast_episodes-view',
                        ]);
                        $routes->get('edit', 'Episode::edit/$1/$2', [
                            'as' => 'episode-edit',
                            'filter' => 'permission:podcast_episodes-edit',
                        ]);
                        $routes->post('edit', 'Episode::attemptEdit/$1/$2', [
                            'filter' => 'permission:podcast_episodes-edit',
                        ]);
                        $routes->get('publish', 'Episode::publish/$1/$2', [
                            'as' => 'episode-publish',
                            'filter' =>
                                'permission:podcast-manage_publications',
                        ]);
                        $routes->post(
                            'publish',
                            'Episode::attemptPublish/$1/$2',
                            [
                                'filter' =>
                                    'permission:podcast-manage_publications',
                            ],
                        );
                        $routes->get(
                            'publish-edit',
                            'Episode::publishEdit/$1/$2',
                            [
                                'as' => 'episode-publish_edit',
                                'filter' =>
                                    'permission:podcast-manage_publications',
                            ],
                        );
                        $routes->post(
                            'publish-edit',
                            'Episode::attemptPublishEdit/$1/$2',
                            [
                                'filter' =>
                                    'permission:podcast-manage_publications',
                            ],
                        );
                        $routes->get('unpublish', 'Episode::unpublish/$1/$2', [
                            'as' => 'episode-unpublish',
                            'filter' =>
                                'permission:podcast-manage_publications',
                        ]);
                        $routes->post(
                            'unpublish',
                            'Episode::attemptUnpublish/$1/$2',
                            [
                                'filter' =>
                                    'permission:podcast-manage_publications',
                            ],
                        );
                        $routes->get('delete', 'Episode::delete/$1/$2', [
                            'as' => 'episode-delete',
                            'filter' => 'permission:podcast_episodes-delete',
                        ]);
                        $routes->get(
                            'transcript-delete',
                            'Episode::transcriptDelete/$1/$2',
                            [
                                'as' => 'transcript-delete',
                                'filter' => 'permission:podcast_episodes-edit',
                            ],
                        );
                        $routes->get(
                            'chapters-delete',
                            'Episode::chaptersDelete/$1/$2',
                            [
                                'as' => 'chapters-delete',
                                'filter' => 'permission:podcast_episodes-edit',
                            ],
                        );
                        $routes->get(
                            'soundbites',
                            'Episode::soundbitesEdit/$1/$2',
                            [
                                'as' => 'soundbites-edit',
                                'filter' => 'permission:podcast_episodes-edit',
                            ],
                        );
                        $routes->post(
                            'soundbites',
                            'Episode::soundbitesAttemptEdit/$1/$2',
                            [
                                'filter' => 'permission:podcast_episodes-edit',
                            ],
                        );
                        $routes->get(
                            'soundbites/(:num)/delete',
                            'Episode::soundbiteDelete/$1/$2/$3',
                            [
                                'as' => 'soundbite-delete',
                                'filter' => 'permission:podcast_episodes-edit',
                            ],
                        );
                        $routes->get(
                            'embeddable-player',
                            'Episode::embeddablePlayer/$1/$2',
                            [
                                'as' => 'embeddable-player-add',
                                'filter' => 'permission:podcast_episodes-edit',
                            ],
                        );

                        $routes->group('persons', function ($routes) {
                            $routes->get('/', 'EpisodePerson/$1/$2', [
                                'as' => 'episode-person-manage',
                                'filter' => 'permission:podcast_episodes-edit',
                            ]);
                            $routes->post(
                                '/',
                                'EpisodePerson::attemptAdd/$1/$2',
                                [
                                    'filter' =>
                                        'permission:podcast_episodes-edit',
                                ],
                            );
                            $routes->get(
                                '(:num)/remove',
                                'EpisodePerson::remove/$1/$2/$3',
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
                $routes->group('contributors', function ($routes) {
                    $routes->get('/', 'Contributor::list/$1', [
                        'as' => 'contributor-list',
                        'filter' =>
                            'permission:podcasts-view,podcast-manage_contributors',
                    ]);
                    $routes->get('add', 'Contributor::add/$1', [
                        'as' => 'contributor-add',
                        'filter' => 'permission:podcast-manage_contributors',
                    ]);
                    $routes->post('add', 'Contributor::attemptAdd/$1', [
                        'filter' => 'permission:podcast-manage_contributors',
                    ]);

                    // Contributor
                    $routes->group('(:num)', function ($routes) {
                        $routes->get('/', 'Contributor::view/$1/$2', [
                            'as' => 'contributor-view',
                            'filter' =>
                                'permission:podcast-manage_contributors',
                        ]);
                        $routes->get('edit', 'Contributor::edit/$1/$2', [
                            'as' => 'contributor-edit',
                            'filter' =>
                                'permission:podcast-manage_contributors',
                        ]);
                        $routes->post(
                            'edit',
                            'Contributor::attemptEdit/$1/$2',
                            [
                                'filter' =>
                                    'permission:podcast-manage_contributors',
                            ],
                        );
                        $routes->get('remove', 'Contributor::remove/$1/$2', [
                            'as' => 'contributor-remove',
                            'filter' =>
                                'permission:podcast-manage_contributors',
                        ]);
                    });
                });

                $routes->group('platforms', function ($routes) {
                    $routes->get(
                        '/',
                        'PodcastPlatform::platforms/$1/podcasting',
                        [
                            'as' => 'platforms-podcasting',
                            'filter' => 'permission:podcast-manage_platforms',
                        ],
                    );
                    $routes->get(
                        'social',
                        'PodcastPlatform::platforms/$1/social',
                        [
                            'as' => 'platforms-social',
                            'filter' => 'permission:podcast-manage_platforms',
                        ],
                    );
                    $routes->get(
                        'funding',
                        'PodcastPlatform::platforms/$1/funding',
                        [
                            'as' => 'platforms-funding',
                            'filter' => 'permission:podcast-manage_platforms',
                        ],
                    );
                    $routes->post(
                        'save/(:platformType)',
                        'PodcastPlatform::attemptPlatformsUpdate/$1/$2',
                        [
                            'as' => 'platforms-save',
                            'filter' => 'permission:podcast-manage_platforms',
                        ],
                    );
                    $routes->get(
                        '(:slug)/podcast-platform-remove',
                        'PodcastPlatform::removePodcastPlatform/$1/$2',
                        [
                            'as' => 'podcast-platform-remove',
                            'filter' => 'permission:podcast-manage_platforms',
                        ],
                    );
                });
            });
        });

        // Instance wide Fediverse config
        $routes->group('fediverse', function ($routes) {
            $routes->get('/', 'Fediverse::dashboard', [
                'as' => 'fediverse-dashboard',
            ]);
            $routes->get('blocked-actors', 'Fediverse::blockedActors', [
                'as' => 'fediverse-blocked-actors',
                'filter' => 'permission:fediverse-block_actors',
            ]);
            $routes->get('blocked-domains', 'Fediverse::blockedDomains', [
                'as' => 'fediverse-blocked-domains',
                'filter' => 'permission:fediverse-block_domains',
            ]);
        });

        // Pages
        $routes->group('pages', function ($routes) {
            $routes->get('/', 'Page::list', ['as' => 'page-list']);
            $routes->get('new', 'Page::create', [
                'as' => 'page-create',
                'filter' => 'permission:pages-manage',
            ]);
            $routes->post('new', 'Page::attemptCreate', [
                'filter' => 'permission:pages-manage',
            ]);

            $routes->group('(:num)', function ($routes) {
                $routes->get('/', 'Page::view/$1', ['as' => 'page-view']);
                $routes->get('edit', 'Page::edit/$1', [
                    'as' => 'page-edit',
                    'filter' => 'permission:pages-manage',
                ]);
                $routes->post('edit', 'Page::attemptEdit/$1', [
                    'filter' => 'permission:pages-manage',
                ]);

                $routes->get('delete', 'Page::delete/$1', [
                    'as' => 'page-delete',
                    'filter' => 'permission:pages-manage',
                ]);
            });
        });

        // Users
        $routes->group('users', function ($routes) {
            $routes->get('/', 'User::list', [
                'as' => 'user-list',
                'filter' => 'permission:users-list',
            ]);
            $routes->get('new', 'User::create', [
                'as' => 'user-create',
                'filter' => 'permission:users-create',
            ]);
            $routes->post('new', 'User::attemptCreate', [
                'filter' => 'permission:users-create',
            ]);

            // User
            $routes->group('(:num)', function ($routes) {
                $routes->get('/', 'User::view/$1', [
                    'as' => 'user-view',
                    'filter' => 'permission:users-view',
                ]);
                $routes->get('edit', 'User::edit/$1', [
                    'as' => 'user-edit',
                    'filter' => 'permission:users-manage_authorizations',
                ]);
                $routes->post('edit', 'User::attemptEdit/$1', [
                    'filter' => 'permission:users-manage_authorizations',
                ]);
                $routes->get('ban', 'User::ban/$1', [
                    'as' => 'user-ban',
                    'filter' => 'permission:users-manage_bans',
                ]);
                $routes->get('unban', 'User::unBan/$1', [
                    'as' => 'user-unban',
                    'filter' => 'permission:users-manage_bans',
                ]);
                $routes->get('force-pass-reset', 'User::forcePassReset/$1', [
                    'as' => 'user-force_pass_reset',
                    'filter' => 'permission:users-force_pass_reset',
                ]);
                $routes->get('delete', 'User::delete/$1', [
                    'as' => 'user-delete',
                    'filter' => 'permission:users-delete',
                ]);
            });
        });

        // My account
        $routes->group('my-account', function ($routes) {
            $routes->get('/', 'MyAccount', [
                'as' => 'my-account',
            ]);
            $routes->get('change-password', 'MyAccount::changePassword/$1', [
                'as' => 'change-password',
            ]);
            $routes->post('change-password', 'MyAccount::attemptChange/$1');
        });
    },
);

/**
 * Overwriting Myth:auth routes file
 */
$routes->group(config('App')->authGateway, function ($routes) {
    // Login/out
    $routes->get('login', 'Auth::login', ['as' => 'login']);
    $routes->post('login', 'Auth::attemptLogin');
    $routes->get('logout', 'Auth::logout', ['as' => 'logout']);

    // Registration
    $routes->get('register', 'Auth::register', [
        'as' => 'register',
    ]);
    $routes->post('register', 'Auth::attemptRegister');

    // Activation
    $routes->get('activate-account', 'Auth::activateAccount', [
        'as' => 'activate-account',
    ]);
    $routes->get('resend-activate-account', 'Auth::resendActivateAccount', [
        'as' => 'resend-activate-account',
    ]);

    // Forgot/Resets
    $routes->get('forgot', 'Auth::forgotPassword', [
        'as' => 'forgot',
    ]);
    $routes->post('forgot', 'Auth::attemptForgot');
    $routes->get('reset-password', 'Auth::resetPassword', [
        'as' => 'reset-password',
    ]);
    $routes->post('reset-password', 'Auth::attemptReset');
});

// Podcast's Public routes
$routes->group('@(:podcastName)', function ($routes) {
    $routes->get('/', 'Podcast::activity/$1', [
        'as' => 'podcast-activity',
    ]);
    // override default ActivityPub Library's actor route
    $routes->get('/', 'Podcast::activity/$1', [
        'as' => 'actor',
        'alternate-content' => [
            'application/activity+json' => [
                'namespace' => 'ActivityPub\Controllers',
                'controller-method' => 'ActorController/$1',
            ],
            'application/ld+json; profile="https://www.w3.org/ns/activitystreams' => [
                'namespace' => 'ActivityPub\Controllers',
                'controller-method' => 'ActorController/$1',
            ],
        ],
    ]);
    $routes->get('episodes', 'Podcast::episodes/$1', [
        'as' => 'podcast-episodes',
    ]);
    $routes->group('episodes/(:slug)', function ($routes) {
        $routes->get('/', 'Episode/$1/$2', [
            'as' => 'episode',
        ]);
        $routes->get('oembed.json', 'Episode::oembedJSON/$1/$2', [
            'as' => 'episode-oembed-json',
        ]);
        $routes->get('oembed.xml', 'Episode::oembedXML/$1/$2', [
            'as' => 'episode-oembed-xml',
        ]);
        $routes->group('embeddable-player', function ($routes) {
            $routes->get('/', 'Episode::embeddablePlayer/$1/$2', [
                'as' => 'embeddable-player',
            ]);
            $routes->get(
                '(:embeddablePlayerTheme)',
                'Episode::embeddablePlayer/$1/$2/$3',
                [
                    'as' => 'embeddable-player-theme',
                ],
            );
        });
    });

    $routes->head('feed.xml', 'Feed/$1', ['as' => 'podcast_feed']);
    $routes->get('feed.xml', 'Feed/$1', ['as' => 'podcast_feed']);
});

// Other pages
$routes->get('/credits', 'Page::credits', ['as' => 'credits']);
$routes->get('/(:slug)', 'Page/$1', ['as' => 'page']);

// interacting as an actor
$routes->post('interact-as-actor', 'Auth::attemptInteractAsActor', [
    'as' => 'interact-as-actor',
]);

/**
 * Overwriting ActivityPub routes file
 */
$routes->group('@(:podcastName)', function ($routes) {
    $routes->post('notes/new', 'Note::attemptCreate/$1', [
        'as' => 'note-attempt-create',
        'filter' => 'permission:podcast-manage_publications',
    ]);
    // Note
    $routes->group('notes/(:uuid)', function ($routes) {
        $routes->get('/', 'Note/$1/$2', [
            'as' => 'note',
            'alternate-content' => [
                'application/activity+json' => [
                    'namespace' => 'ActivityPub\Controllers',
                    'controller-method' => 'NoteController/$2',
                ],
                'application/ld+json; profile="https://www.w3.org/ns/activitystreams' => [
                    'namespace' => 'ActivityPub\Controllers',
                    'controller-method' => 'NoteController/$2',
                ],
            ],
        ]);
        $routes->get('replies', 'Note/$1/$2', [
            'as' => 'note-replies',
            'alternate-content' => [
                'application/activity+json' => [
                    'namespace' => 'ActivityPub\Controllers',
                    'controller-method' => 'NoteController::replies/$2',
                ],
                'application/ld+json; profile="https://www.w3.org/ns/activitystreams' => [
                    'namespace' => 'ActivityPub\Controllers',
                    'controller-method' => 'NoteController::replies/$2',
                ],
            ],
        ]);

        // Actions
        $routes->post('action', 'Note::attemptAction/$1/$2', [
            'as' => 'note-attempt-action',
            'filter' => 'permission:podcast-interact_as',
        ]);

        $routes->post('block-actor', 'Note::attemptBlockActor/$1/$2', [
            'as' => 'note-attempt-block-actor',
            'filter' => 'permission:fediverse-block_actors',
        ]);
        $routes->post('block-domain', 'Note::attemptBlockDomain/$1/$2', [
            'as' => 'note-attempt-block-domain',
            'filter' => 'permission:fediverse-block_domains',
        ]);
        $routes->post('delete', 'Note::attemptDelete/$1/$2', [
            'as' => 'note-attempt-delete',
            'filter' => 'permission:podcast-manage_publications',
        ]);

        $routes->get('remote/(:noteAction)', 'Note::remoteAction/$1/$2/$3', [
            'as' => 'note-remote-action',
        ]);
    });

    $routes->get('follow', 'Actor::follow/$1', [
        'as' => 'follow',
    ]);
    $routes->get('outbox', 'Actor::outbox/$1', [
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
