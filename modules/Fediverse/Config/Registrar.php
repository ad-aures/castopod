<?php

declare(strict_types=1);

namespace Modules\Fediverse\Config;

use Modules\Fediverse\Filters\FediverseFilter;

class Registrar
{
    /**
     * @return array<string, mixed>
     */
    public static function Filters(): array
    {
        return [
            'aliases' => [
                'fediverse' => FediverseFilter::class,
            ],
        ];
    }
}
