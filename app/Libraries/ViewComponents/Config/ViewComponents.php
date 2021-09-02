<?php

declare(strict_types=1);

namespace ViewComponents\Config;

use CodeIgniter\Config\BaseConfig;

class ViewComponents extends BaseConfig
{
    public string $componentsDirectory = 'Components';

    /**
     * Paths to look into for local components. Will look for the $componentsDirectory inside.
     *
     * @var string[]
     */
    public array $lookupPaths = [];

    public string $defaultLookupPath = APPPATH . 'Views/';
}
