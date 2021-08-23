<?php

declare(strict_types=1);

namespace Modules\Install\Config;

use CodeIgniter\Config\BaseConfig;

class Install extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Install gateway
     * --------------------------------------------------------------------------
     * Defines a base route for instance installation
     */
    public string $gateway = 'cp-install';
}
