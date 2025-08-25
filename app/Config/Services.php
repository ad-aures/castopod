<?php

declare(strict_types=1);

namespace Config;

use App\Libraries\Breadcrumb;
use App\Libraries\Negotiate;
use App\Libraries\Router;
use CodeIgniter\Config\BaseService;
use CodeIgniter\HTTP\Negotiate as CodeIgniterHTTPNegotiate;
use CodeIgniter\HTTP\Request;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Router\RouteCollectionInterface;
use CodeIgniter\Router\Router as CodeIgniterRouter;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses to do its job. This is used by CodeIgniter to allow
 * the core of the framework to be swapped out easily without affecting the usage within the rest of your application.
 *
 * This file holds any application-specific services, or service overrides that you might need. An example has been
 * included with the general method format you should use for your service methods. For more examples, see the core
 * Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    /**
     * The Router class uses a RouteCollection's array of routes, and determines the correct Controller and Method to
     * execute.
     */
    public static function router(
        ?RouteCollectionInterface $routes = null,
        ?Request $request = null,
        bool $getShared = true
    ): CodeIgniterRouter {
        if ($getShared) {
            return static::getSharedInstance('router', $routes, $request);
        }

        $routes ??= static::routes();
        $request ??= static::request();

        return new Router($routes, $request);
    }

    /**
     * The Negotiate class provides the content negotiation features for working the request to determine correct
     * language, encoding, charset, and more.
     */
    public static function negotiator(
        ?RequestInterface $request = null,
        bool $getShared = true
    ): CodeIgniterHTTPNegotiate {
        if ($getShared) {
            return static::getSharedInstance('negotiator', $request);
        }

        $request ??= static::request();

        return new Negotiate($request);
    }

    public static function breadcrumb(bool $getShared = true): Breadcrumb
    {
        if ($getShared) {
            return self::getSharedInstance('breadcrumb');
        }

        return new Breadcrumb();
    }
}
