<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Config;

use CodeIgniter\Config\BaseService;
use Modules\Api\Rest\V1\Core\RestApiExceptions;

class Services extends BaseService
{
    public static function restApiExceptions(bool $getShared = true): RestApiExceptions
    {
        if ($getShared) {
            return static::getSharedInstance('restApiExceptions');
        }

        return new RestApiExceptions(config('Exceptions'));
    }
}
