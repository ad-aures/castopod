<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Config;

use CodeIgniter\Config\BaseService;
use Modules\Api\Rest\V1\Core\Exceptions;

class Services extends BaseService
{
    public static function restApiExceptions(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('restApiExceptions');
        }

        return new Exceptions(config('Exceptions'), static::request(), static::response());
    }
}
