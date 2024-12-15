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
    protected const VALIDATION_RULES = [
        'type'      => 'permit_empty|in_list[git]',
        'url'       => 'required|valid_url_strict',
        'directory' => 'permit_empty',
    ];

    /**
     * @var array<string,array{string}|string>
     */
    protected const CASTS = [
        'url' => URI::class,
    ];

    protected string $type = 'git';

    protected URI $url;

    protected ?string $directory = null;
}
