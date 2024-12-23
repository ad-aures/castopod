<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

use CodeIgniter\HTTP\URI;

/**
 * @property string $type
 * @property URI $url
 * @property ?string $directory
 */
class Repository extends ManifestObject
{
    public static array $validation_rules = [
        'type'      => 'permit_empty|in_list[git]',
        'url'       => 'required|valid_url_strict',
        'directory' => 'permit_empty',
    ];

    /**
     * @var array<string,array{string}|string>
     */
    protected array $casts = [
        'url' => URI::class,
    ];

    protected string $type = 'git';

    protected URI $url;

    protected ?string $directory = null;
}
