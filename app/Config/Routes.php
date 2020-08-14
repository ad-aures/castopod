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
$routes->addPlaceholder('episodeSlug', '[a-zA-Z0-9\-]{1,191}');

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

// Public routes
$routes->group('@(:podcastName)', function ($routes) {
    $routes->get('/', 'Podcast/$1', ['as' => 'podcast']);
    $routes->get('(:episodeSlug)', 'Episode/$1/$2', [
        'as' => 'episode',
    ]);
    $routes->get('feed.xml', 'Feed/$1', ['as' => 'podcast_feed']);
});

// Route for podcast audio file analytics (/stats/podcast_id/episode_id/podcast_folder/filename.mp3)
$routes->add('stats/(:num)/(:num)/(:any)', 'Analytics::hit/$1/$2/$3', [
    'as' => 'analytics_hit',
]);

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

            // Podcast
            // Use ids in admin area to help permission and group lookups
            $routes->group('(:num)', function ($routes) {
                $routes->get('/', 'Podcast::view/$1', [
                    'as' => 'podcast-view',
                    'filter' => 'permission:podcasts-view,podcast-view',
                ]);
                $routes->get('edit', 'Podcast::edit/$1', [
                    'as' => 'podcast-edit',
                    'filter' => 'permission:podcasts-edit,podcast-edit',
                ]);
                $routes->post('edit', 'Podcast::attemptEdit/$1', [
                    'filter' => 'permission:podcasts-edit,podcast-edit',
                ]);
                $routes->add('delete', 'Podcast::delete/$1', [
                    'as' => 'podcast-delete',
                    'filter' => 'permission:podcasts-edit,podcast-delete',
                ]);

                // Podcast episodes
                $routes->group('episodes', function ($routes) {
                    $routes->get('/', 'Episode::list/$1', [
                        'as' => 'episode-list',
                        'filter' => 'permission:podcasts-view,podcast-view',
                    ]);
                    $routes->get('new', 'Episode::create/$1', [
                        'as' => 'episode-create',
                        'filter' =>
                            'permission:episodes-create,podcast_episodes-create',
                    ]);
                    $routes->post('new', 'Episode::attemptCreate/$1', [
                        'filter' =>
                            'permission:episodes-create,podcast_episodes-create',
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
                            'filter' =>
                                'permission:episodes-edit,podcast_episodes-edit',
                        ]);
                        $routes->post('edit', 'Episode::attemptEdit/$1/$2', [
                            'filter' =>
                                'permission:episodes-edit,podcast_episodes-edit',
                        ]);
                        $routes->add('delete', 'Episode::delete/$1/$2', [
                            'as' => 'episode-delete',
                            'filter' =>
                                'permission:episodes-delete,podcast_episodes-delete',
                        ]);
                    });
                });

                // Podcast contributors
                $routes->group('contributors', function ($routes) {
                    $routes->get('/', 'Contributor::list/$1', [
                        'as' => 'contributor-list',
                        'filter' =>
                            'permission:podcasts-manage_contributors,podcast-manage_contributors',
                    ]);
                    $routes->get('add', 'Contributor::add/$1', [
                        'as' => 'contributor-add',
                        'filter' =>
                            'permission:podcasts-manage_contributors,podcast-manage_contributors',
                    ]);
                    $routes->post('add', 'Contributor::attemptAdd/$1', [
                        'filter' =>
                            'permission:podcasts-manage_contributors,podcast-manage_contributors',
                    ]);

                    // Contributor
                    $routes->group('(:num)', function ($routes) {
                        $routes->get('/', 'Contributor::view/$1/$2', [
                            'as' => 'contributor-view',
                        ]);
                        $routes->get('edit', 'Contributor::edit/$1/$2', [
                            'as' => 'contributor-edit',
                            'filter' =>
                                'permission:podcasts-manage_contributors,podcast-manage_contributors',
                        ]);
                        $routes->post(
                            'edit',
                            'Contributor::attemptEdit/$1/$2',
                            [
                                'filter' =>
                                    'permission:podcasts-manage_contributors,podcast-manage_contributors',
                            ]
                        );
                        $routes->add('remove', 'Contributor::remove/$1/$2', [
                            'as' => 'contributor-remove',
                            'filter' =>
                                'permission:podcasts-manage_contributors,podcast-manage_contributors',
                        ]);
                    });
                });
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
            $routes->get('/', 'Myaccount', [
                'as' => 'my-account',
            ]);
            $routes->get('change-password', 'Myaccount::changePassword/$1', [
                'as' => 'change-password',
            ]);
            $routes->post('change-password', 'Myaccount::attemptChange/$1');
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
