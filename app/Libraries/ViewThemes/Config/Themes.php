<?php

declare(strict_types=1);

namespace ViewThemes\Config;

use CodeIgniter\Config\BaseConfig;

class Themes extends BaseConfig
{
    public string $themesDirectory = ROOTPATH . 'themes';

    public string $manifestFilename = 'manifest.json';

    /**
     * @var array<string, string>
     */
    public array $themes = [
        'app' => 'cp_app',
        'admin' => 'cp_admin',
        'install' => 'cp_install',
        'auth' => 'cp_auth',
    ];
}
