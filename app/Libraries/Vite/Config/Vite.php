<?php

declare(strict_types=1);

namespace Vite\Config;

use CodeIgniter\Config\BaseConfig;

class Vite extends BaseConfig
{
    public string $environment = 'production';

    public string $baseUrl = 'http://localhost:5173/';

    public string $assetsRoot = 'assets';

    public string $manifestFile = '.vite/manifest.json';

    public string $manifestCSSFile = 'manifest-css.json';
}
