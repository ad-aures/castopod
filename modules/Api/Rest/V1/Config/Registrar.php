<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Config;

use Modules\Api\Rest\V1\Filters\ApiFilter;

class Registrar
{
    public static function Filters(): array
    {
        return [
            'aliases' => [
                'rest-api' => ApiFilter::class,
            ],
        ];
    }
}
