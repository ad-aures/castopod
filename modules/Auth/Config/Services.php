<?php

declare(strict_types=1);

namespace Modules\Auth\Config;

use Config\Services as BaseService;
use Modules\Auth\Auth;
use Modules\Auth\Config\Auth as AuthConfig;

class Services extends BaseService
{
    /**
     * The base auth class
     */
    public static function auth(bool $getShared = true): Auth
    {
        if ($getShared) {
            /** @var Auth */
            return self::getSharedInstance('auth');
        }

        $config = config(AuthConfig::class);

        return new Auth($config);
    }
}
