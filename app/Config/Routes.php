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

$routes->addPlaceholder('podcastName', '[a-zA-Z0-9\_]{1,191}');
$routes->addPlaceholder('slug', '[a-zA-Z0-9\-]{1,191}');

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
    $routes->post('generate-env', 'Install::attemptCreateEnv', [
        'as' => 'generate-env',
    ]);
    $routes->post('create-superadmin', 'Install::attemptCreateSuperAdmin', [
        'as' => 'create-superadmin',
    ]);
});

// Route for podcast audio file analytics (/audio/podcast_id/episode_id/bytes_threshold/filesize/podcast_folder/filename.mp3)
$routes->add(
    'audio/(:num)/(:num)/(:num)/(:num)/(:any)',
    'Analytics::hit/$1/$2/$3/$4/$5',
    [
        'as' => 'analytics_hit',
    ]
);

// Show the Unknown UserAgents
$routes->get('.well-known/unknown-useragents', 'UnknownUserAgents');
$routes->get('.well-known/unknown-useragents/(:num)', 'UnknownUserAgents/$1');

// Admin area
$routes->group(
    config('App')->adminGateway,
    ['namespace' => 'App\Controllers\Admin'],
    function ($routes) {
        $routes->get('/', 'Home', [
            'as' => 'admin',
        ]);

        $routes->get('my-podcasts', 'Podcast::myPodcasts', [
            'as' => 'my-podcasts',
        ]);

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
            $routes->get('import', 'Podcast::import', [
                'as' => 'podcast-import',
                'filter' => 'permission:podcasts-import',
            ]);
            $routes->post('import', 'Podcast::attemptImport', [
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
                $routes->add('delete', 'Podcast::delete/$1', [
                    'as' => 'podcast-delete',
                    'filter' => 'permission:podcasts-delete',
                ]);
                $routes->get('analytics', 'Podcast::analytics/$1', [
                    'as' => 'podcast-analytics',
                    'filter' => 'permission:podcasts-view,podcast-view',
                ]);
                $routes->get(
                    'analytics-data/(:segment)',
                    'AnalyticsData::getData/$1/$2',
                    [
                        'as' => 'analytics-full-data',
                        'filter' => 'permission:podcasts-view,podcast-view',
                    ]
                );
                $routes->get(
                    'analytics-data/(:segment)/(:segment)',
                    'AnalyticsData::getData/$1/$2/$3',
                    [
                        'as' => 'analytics-data',
                        'filter' => 'permission:podcasts-view,podcast-view',
                    ]
                );
                $routes->get(
                    'analytics-data/(:segment)/(:segment)/(:num)',
                    'AnalyticsData::getData/$1/$2/$3/$4',
                    [
                        'as' => 'analytics-filtered-data',
                        'filter' => 'permission:podcasts-view,podcast-view',
                    ]
                );

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
                        $routes->add('delete', 'Episode::delete/$1/$2', [
                            'as' => 'episode-delete',
                            'filter' => 'permission:podcast_episodes-delete',
                        ]);
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
                            ]
                        );
                        $routes->add('remove', 'Contributor::remove/$1/$2', [
                            'as' => 'contributor-remove',
                            'filter' =>
                                'permission:podcast-manage_contributors',
                        ]);
                    });
                });

                $routes->group('settings', function ($routes) {
                    $routes->get('/', 'PodcastSettings/$1', [
                        'as' => 'podcast-settings',
                    ]);
                    $routes->get('platforms', 'PodcastSettings::platforms/$1', [
                        'as' => 'platforms',
                        'filter' => 'permission:podcast-manage_platforms',
                    ]);
                    $routes->post(
                        'platforms',
                        'PodcastSettings::attemptPlatformsUpdate/$1',
                        ['filter' => 'permission:podcast-manage_platforms']
                    );

                    $routes->add(
                        'platforms/(:num)/remove-link',
                        'PodcastSettings::removePlatformLink/$1/$2',
                        [
                            'as' => 'platforms-remove',
                            'filter' => 'permission:podcast-manage_platforms',
                        ]
                    );
                });
            });
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

                $routes->add('delete', 'Page::delete/$1', [
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
                $routes->add('ban', 'User::ban/$1', [
                    'as' => 'user-ban',
                    'filter' => 'permission:users-manage_bans',
                ]);
                $routes->add('unban', 'User::unBan/$1', [
                    'as' => 'user-unban',
                    'filter' => 'permission:users-manage_bans',
                ]);
                $routes->add('force-pass-reset', 'User::forcePassReset/$1', [
                    'as' => 'user-force_pass_reset',
                    'filter' => 'permission:users-force_pass_reset',
                ]);
                $routes->add('delete', 'User::delete/$1', [
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
    }
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

// Public routes
$routes->group('@(:podcastName)', function ($routes) {
    $routes->get('/', 'Podcast/$1', ['as' => 'podcast']);
    $routes->get('(:slug)', 'Episode/$1/$2', [
        'as' => 'episode',
    ]);
    $routes->get('feed.xml', 'Feed/$1', ['as' => 'podcast_feed']);
});
$routes->get('/(:slug)', 'Page/$1', ['as' => 'page']);

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
