<?php

declare(strict_types=1);

namespace ViewComponents\Config;

use CodeIgniter\Config\BaseConfig;

class ViewComponents extends BaseConfig
{
    public string $classComponentsPath = 'View/Components';

    public string $viewFileComponentsPath = 'Views/components';
}
