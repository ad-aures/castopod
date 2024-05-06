<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

/**
 * @property SettingsField[] $general
 * @property SettingsField[] $podcast
 * @property SettingsField[] $episode
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
        'general' => [SettingsField::class],
        'podcast' => [SettingsField::class],
        'episode' => [SettingsField::class],
    ];

    /**
     * @var SettingsField[]
     */
    protected array $general = [];

    /**
     * @var SettingsField[]
     */
    protected array $podcast = [];

    /**
     * @var SettingsField[]
     */
    protected array $episode = [];
}
