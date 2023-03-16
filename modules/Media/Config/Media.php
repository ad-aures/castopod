<?php

declare(strict_types=1);

namespace Modules\Media\Config;

use CodeIgniter\Config\BaseConfig;
use Modules\Media\FileManagers\FS;
use Modules\Media\FileManagers\S3;

class Media extends BaseConfig
{
    public string $fileManager = 'fs';

    /**
     * @var array<string, string>
     */
    public array $fileManagers = [
        'fs' => FS::class,
        's3' => S3::class,
    ];

    /**
     * @var array<string, null|string|bool>
     */
    public array $s3 = [
        'bucket' => 'castopod',
        'key' => '',
        'secret' => '',
        'region' => '',
        'protocol' => '',
        'endpoint' => '',
        'debug' => false,
        'path_style_endpoint' => false,
    ];

    /**
     * --------------------------------------------------------------------------
     * Media Base URL
     * --------------------------------------------------------------------------
     *
     * URL to your media root. Typically this will be your base URL,
     * WITH a trailing slash:
     *
     *    http://cdn.example.com/
     */
    public string $baseURL = 'http://localhost:8080/';

    /**
     * --------------------------------------------------------------------------
     * Media root folder
     * --------------------------------------------------------------------------
     * Defines the root folder for media files storage
     */
    public string $root = 'media';

    /**
     * @var array<string, string>
     */
    public array $folders = [
        'podcasts' => 'podcasts',
        'persons' => 'persons',
    ];
}
