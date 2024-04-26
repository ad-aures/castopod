<?php

declare(strict_types=1);

namespace Modules\Platforms\Config;

use CodeIgniter\Config\BaseService;
use Modules\Platforms\Platforms;

class Services extends BaseService
{
    public static function platforms(bool $getShared = true): Platforms
    {
        if ($getShared) {
            return self::getSharedInstance('platforms');
        }

        return new Platforms();
    }
}
