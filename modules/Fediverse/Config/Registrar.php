<?php

declare(strict_types=1);

namespace Modules\Fediverse\Config;

use Modules\Fediverse\Filters\AllowCorsFilter;
use Modules\Fediverse\Filters\FediverseFilter;

class Registrar
{
    public static function Filters(): array
    {
        return [
            'aliases' => [
                'fediverse'  => FediverseFilter::class,
                'allow-cors' => AllowCorsFilter::class,
            ],
        ];
    }
}
