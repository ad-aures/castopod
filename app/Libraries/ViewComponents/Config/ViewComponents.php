<?php

declare(strict_types=1);

namespace ViewComponents\Config;

use CodeIgniter\Config\BaseConfig;

class ViewComponents extends BaseConfig
{
    public string $classComponentsPath = 'View/Components';

    public string $viewFileComponentsPath = 'Views/components';

    /**
     * Modules to look into for local components. Associative array with the module namespace as key and the module path
     * as value.
     *
     * @var array<string, string>
     */
    public array $lookupModules = [];

    public string $defaultLookupPath = APPPATH;
}
