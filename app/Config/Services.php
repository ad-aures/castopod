<?php

declare(strict_types=1);

namespace Config;

use App\Authorization\FlatAuthorization;
use App\Authorization\GroupModel;
use App\Authorization\PermissionModel;
use App\Libraries\Breadcrumb;
use App\Libraries\Negotiate;
use App\Libraries\Router;
use App\Libraries\Vite;
use App\Models\UserModel;
use CodeIgniter\Config\BaseService;
use CodeIgniter\HTTP\Request;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;
use CodeIgniter\Router\RouteCollectionInterface;
use Myth\Auth\Models\LoginModel;

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

    /**
     * @return mixed
     */
    public static function authentication(
        string $lib = 'local',
        Model $userModel = null,
        Model $loginModel = null,
        bool $getShared = true
    ) {
        if ($getShared) {
            return self::getSharedInstance('authentication', $lib, $userModel, $loginModel);
        }

        // config() checks first in app/Config
        $config = config('Auth');

        $class = $config->authenticationLibs[$lib];

        $instance = new $class($config);

        if ($userModel === null) {
            $userModel = new UserModel();
        }

        if ($loginModel === null) {
            $loginModel = new LoginModel();
        }

        return $instance->setUserModel($userModel)
            ->setLoginModel($loginModel);
    }

    /**
     * @return mixed
     */
    public static function authorization(
        Model $groupModel = null,
        Model $permissionModel = null,
        Model $userModel = null,
        bool $getShared = true
    ) {
        if ($getShared) {
            return self::getSharedInstance('authorization', $groupModel, $permissionModel, $userModel);
        }

        if ($groupModel === null) {
            $groupModel = new GroupModel();
        }

        if ($permissionModel === null) {
            $permissionModel = new PermissionModel();
        }

        $instance = new FlatAuthorization($groupModel, $permissionModel);

        if ($userModel === null) {
            $userModel = new UserModel();
        }

        return $instance->setUserModel($userModel);
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
