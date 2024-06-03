<?php

declare(strict_types=1);

namespace Modules\Plugins\Config;

use CodeIgniter\Config\BaseConfig;

class Plugins extends BaseConfig
{
    public string $folder = PLUGINS_PATH;

    /**
     * @var list<string>
     */
    public array $repositories = ['https://castopod.org/plugins/repository.json'];
}
