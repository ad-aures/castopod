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
$routes->addPlaceholder('podcastName', '[a-zA-Z0-9\_]{1,191}');
$routes->addPlaceholder('episodeSlug', '[a-zA-Z0-9\-]{1,191}');
$routes->addPlaceholder('username', '[a-zA-Z0-9 ]{3,}');

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['as' => 'home']);

$routes->group('@(:podcastName)', function ($routes) {
    $routes->add('/', 'Podcast/$1', ['as' => 'podcast']);

    $routes->add('feed.xml', 'Feed/$1', ['as' => 'podcast_feed']);
    $routes->add('episodes/(:episodeSlug)', 'Episode/$1/$2', [
        'as' => 'episode',
    ]);
});

// Route for podcast audio file analytics (/stats/podcast_id/episode_id/podcast_folder/filename.mp3)
$routes->add('stats/(:num)/(:num)/(:any)', 'Analytics::hit/$1/$2/$3', [
    'as' => 'analytics_hit',
]);

// Show the Unknown UserAgents
$routes->add('.well-known/unknown-useragents', 'UnknownUserAgents');
$routes->add('.well-known/unknown-useragents/(:num)', 'UnknownUserAgents/$1');

// Admin area
$routes->group(
    config('App')->adminGateway,
    ['namespace' => 'App\Controllers\Admin'],
    function ($routes) {
        $routes->add('/', 'Home', [
            'as' => 'admin',
        ]);

        $routes->add('new-podcast', 'Podcast::create', [
            'as' => 'podcast_create',
        ]);
        $routes->add('podcasts', 'Podcast::list', ['as' => 'podcast_list']);

        $routes->group('podcasts/@(:podcastName)', function ($routes) {
            $routes->add('edit', 'Podcast::edit/$1', [
                'as' => 'podcast_edit',
            ]);
            $routes->add('delete', 'Podcast::delete/$1', [
                'as' => 'podcast_delete',
            ]);

            $routes->add('new-episode', 'Episode::create/$1', [
                'as' => 'episode_create',
            ]);
            $routes->add('episodes', 'Episode::list/$1', [
                'as' => 'episode_list',
            ]);

            $routes->add(
                'episodes/(:episodeSlug)/edit',
                'Episode::edit/$1/$2',
                [
                    'as' => 'episode_edit',
                ]
            );
            $routes->add(
                'episodes/(:episodeSlug)/delete',
                'Episode::delete/$1/$2',
                [
                    'as' => 'episode_delete',
                ]
            );
        });

        // Users
        $routes->add('users', 'User::list', ['as' => 'user_list']);
        $routes->add('new-user', 'User::create', ['as' => 'user_create']);

        $routes->add('users/@(:any)/ban', 'User::ban/$1', [
            'as' => 'user_ban',
        ]);
        $routes->add('users/@(:any)/unban', 'User::unBan/$1', [
            'as' => 'user_unban',
        ]);
        $routes->add(
            'users/@(:any)/force-pass-reset',
            'User::forcePassReset/$1',
            [
                'as' => 'user_force_pass_reset',
            ]
        );

        $routes->add('users/@(:any)/delete', 'User::delete/$1', [
            'as' => 'user_delete',
        ]);

        // My account
        $routes->get('my-account', 'Myaccount', [
            'as' => 'myAccount',
        ]);
        $routes->get(
            'my-account/change-password',
            'Myaccount::changePassword/$1',
            [
                'as' => 'myAccount_change-password',
            ]
        );
        $routes->post(
            'my-account/change-password',
            'Myaccount::attemptChange/$1',
            [
                'as' => 'myAccount_change-password',
            ]
        );
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
    $routes->get('change-password', 'Auth::changePassword', [
        'as' => 'change_pass',
    ]);
    $routes->post('change-password', 'Auth::attemptChange');
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
