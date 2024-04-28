<?php

declare(strict_types=1);

namespace Modules\Plugins\Config;

use CodeIgniter\Config\BaseService;
use Modules\Plugins\Plugins;

class Services extends BaseService
{
    public static function plugins(bool $getShared = true): Plugins
    {
        if ($getShared) {
            return self::getSharedInstance('plugins');
        }

        return new Plugins();
    }
}
