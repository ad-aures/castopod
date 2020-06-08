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
$routes->addPlaceholder('podcastSlug', '@[a-z0-9\_]{1,191}');
$routes->addPlaceholder('episodeSlug', '[a-z0-9\-]{1,191}');

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['as' => 'home']);
$routes->add('new-podcast', 'Podcasts::create', ['as' => 'podcasts_create']);

$routes->group('(:podcastSlug)', function ($routes) {
    $routes->add('/', 'Podcasts::view/$1', ['as' => 'podcasts_view']);
    $routes->add('new-episode', 'Episodes::create/$1', [
        'as' => 'episodes_create',
    ]);
    $routes->add('(:episodeSlug)', 'Episodes::view/$1/$2', [
        'as' => 'episodes_view',
    ]);
});

// Route for podcast audio file analytics (/stats/podcast_id/episode_id/podcast_folder/filename.mp3)
$routes->add('/stats/(:num)/(:num)/(:any)', 'Analytics::hit/$1/$2/$3');

// Show the Unknown UserAgents
$routes->add('/.well-known/unknown-useragents', 'UnknownUserAgents');
$routes->add('/.well-known/unknown-useragents/(:num)', 'UnknownUserAgents/$1');

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