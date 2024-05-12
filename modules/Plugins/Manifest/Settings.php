<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

/**
 * @property Field[] $general
 * @property Field[] $podcast
 * @property Field[] $episode
 */
class Settings extends ManifestObject
{
    protected const VALIDATION_RULES = [
        'general' => 'permit_empty|is_list',
        'podcast' => 'permit_empty|is_list',
        'episode' => 'permit_empty|is_list',
    ];

    /**
     * @var array<string,array{string}|string>
     */
    protected const CASTS = [
        'general' => [Field::class],
        'podcast' => [Field::class],
        'episode' => [Field::class],
    ];

    /**
     * @var Field[]
     */
    protected array $general = [];

    /**
     * @var Field[]
     */
    protected array $podcast = [];

    /**
     * @var Field[]
     */
    protected array $episode = [];
}
