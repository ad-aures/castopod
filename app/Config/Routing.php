<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\Routing as BaseRouting;

/**
 * Routing configuration
 */
class Routing extends BaseRouting
{
    /**
     * An array of files that contain route definitions.
     * Route files are read in order, with the first match
     * found taking precedence.
     *
     * Default: APPPATH . 'Config/Routes.php'
     *
     * @var string[]
     */
    public array $routeFiles = [
        APPPATH . 'Config/Routes.php',
        ROOTPATH . 'modules/Admin/Config/Routes.php',
        ROOTPATH . 'modules/Analytics/Config/Routes.php',
        ROOTPATH . 'modules/Api/Rest/V1/Config/Routes.php',
        ROOTPATH . 'modules/Auth/Config/Routes.php',
        ROOTPATH . 'modules/Fediverse/Config/Routes.php',
        ROOTPATH . 'modules/Install/Config/Routes.php',
        ROOTPATH . 'modules/Media/Config/Routes.php',
        ROOTPATH . 'modules/PodcastImport/Config/Routes.php',
        ROOTPATH . 'modules/PremiumPodcasts/Config/Routes.php',
    ];

    /**
     * The default namespace to use for Controllers when no other
     * namespace has been specified.
     *
     * Default: 'App\Controllers'
     */
    public string $defaultNamespace = 'App\Controllers';

    /**
     * The default controller to use when no other controller has been
     * specified.
     *
     * Default: 'Home'
     */
    public string $defaultController = 'HomeController';

    /**
     * The default method to call on the controller when no other
     * method has been set in the route.
     *
     * Default: 'index'
     */
    public string $defaultMethod = 'index';

    /**
     * Whether to translate dashes in URIs to underscores.
     * Primarily useful when using the auto-routing.
     *
     * Default: false
     */
    public bool $translateURIDashes = false;

    /**
     * Sets the class/method that should be called if routing doesn't
     * find a match. It can be either a closure or the controller/method
     * name exactly like a route is defined: Users::index
     *
     * This setting is passed to the Router class and handled there.
     *
     * If you want to use a closure, you will have to set it in the
     * class constructor or the routes file by calling:
     *
     * $routes->set404Override(function() {
     *    // Do something here
     * });
     *
     * Example:
     *  public $override404 = 'App\Errors::show404';
     */
    public ?string $override404 = null;

    /**
     * If TRUE, the system will attempt to match the URI against
     * Controllers by matching each segment against folders/files
     * in APPPATH/Controllers, when a match wasn't found against
     * defined routes.
     *
     * If FALSE, will stop searching and do NO automatic routing.
     */
    public bool $autoRoute = false;

    /**
     * If TRUE, will enable the use of the 'prioritize' option
     * when defining routes.
     *
     * Default: false
     */
    public bool $prioritize = false;

    /**
     * Map of URI segments and namespaces. For Auto Routing (Improved).
     *
     * The key is the first URI segment. The value is the controller namespace.
     * E.g.,
     *   [
     *       'blog' => 'Acme\Blog\Controllers',
     *   ]
     *
     * @var array<string, string> [ uri_segment => namespace ]
     */
    public array $moduleRoutes = [];
}
