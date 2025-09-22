<?php

declare(strict_types=1);

namespace Modules\Plugins\Config;

use CodeIgniter\Config\BaseConfig;

class Plugins extends BaseConfig
{
    public string $folder = PLUGINS_PATH;

    public string $repositoryUrl = 'https://plugins.castopod.org/';
}
