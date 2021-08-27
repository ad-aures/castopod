<?php

declare(strict_types=1);

namespace Config;

use App\Libraries\Breadcrumb;
use App\Libraries\Negotiate;
use App\Libraries\Router;
use App\Libraries\View;
use App\Libraries\Vite;
use CodeIgniter\Config\BaseService;
use CodeIgniter\HTTP\Request;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Router\RouteCollectionInterface;
use Config\Services as AppServices;
use Config\View as ViewConfig;

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
     *
     * @noRector PHPStan\Reflection\MissingMethodFromReflectionException
     */
    public static function router(
        ?RouteCollectionInterface $routes = null,
        ?Request $request = null,
        bool $getShared = true
    ): Router {
        if ($getShared) {
            return static::getSharedInstance('router', $routes, $request);
        }

        $routes = $routes ?? static::routes();
        $request = $request ?? static::request();

        return new Router($routes, $request);
    }

    /**
     * The Renderer class is the class that actually displays a file to the user. The default View class within
     * CodeIgniter is intentionally simple, but this service could easily be replaced by a template engine if the user
     * needed to.
     */
    public static function renderer(?string $viewPath = null, ?ViewConfig $config = null, bool $getShared = true): View
    {
        if ($getShared) {
            return static::getSharedInstance('renderer', $viewPath, $config);
        }

        $viewPath = $viewPath ?: config('Paths')
            ->viewDirectory;
        $config = $config ?? config('View');

        return new View($config, $viewPath, AppServices::locator(), CI_DEBUG, AppServices::logger());
    }

    /**
     * The Negotiate class provides the content negotiation features for working the request to determine correct
     * language, encoding, charset, and more.
     *
     * @noRector PHPStan\Reflection\MissingMethodFromReflectionException
     */
    public static function negotiator(?RequestInterface $request = null, bool $getShared = true): Negotiate
    {
        if ($getShared) {
            return static::getSharedInstance('negotiator', $request);
        }

        $request = $request ?? static::request();

        return new Negotiate($request);
    }

    public static function breadcrumb(bool $getShared = true): Breadcrumb
    {
        if ($getShared) {
            return self::getSharedInstance('breadcrumb');
        }

        return new Breadcrumb();
    }

    public static function vite(bool $getShared = true): Vite
    {
        if ($getShared) {
            return self::getSharedInstance('vite');
        }

        return new Vite();
    }
}
