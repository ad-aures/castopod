<?php

declare(strict_types=1);

namespace Modules\Auth\Config;

use Config\Services as BaseService;
use Modules\Auth\Auth;

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

        $config = config('Auth');

        return new Auth($config);
    }
}
