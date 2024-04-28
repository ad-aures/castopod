<?php

declare(strict_types=1);

namespace Modules\PremiumPodcasts\Config;

use Modules\PremiumPodcasts\Filters\PodcastUnlockFilter;

class Registrar
{
    /**
     * @return array<string, mixed>
     */
    public static function Filters(): array
    {
        return [
            'aliases' => [
                'podcast-unlock' => PodcastUnlockFilter::class,
            ],
        ];
    }
}
