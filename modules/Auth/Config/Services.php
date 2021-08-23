<?php

declare(strict_types=1);

namespace Modules\Auth\Config;

use App\Models\UserModel;
use CodeIgniter\Config\BaseService;
use CodeIgniter\Model;
use Modules\Auth\Authorization\FlatAuthorization;
use Modules\Auth\Authorization\GroupModel;
use Modules\Auth\Authorization\PermissionModel;
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
     * @return mixed|$this
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

        /* @phpstan-ignore-next-line */
        $instance = new FlatAuthorization($groupModel, $permissionModel);

        if ($userModel === null) {
            $userModel = new UserModel();
        }

        /* @phpstan-ignore-next-line */
        return $instance->setUserModel($userModel);
    }
}
