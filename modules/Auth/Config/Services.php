<?php

declare(strict_types=1);

namespace Modules\Auth\Config;

use CodeIgniter\Shield\Authentication\Authentication;
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
            return self::getSharedInstance('auth');
        }

        $config = config('Auth');

        return new Auth(new Authentication($config));
    }
}
