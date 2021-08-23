<?php

declare(strict_types=1);

namespace Modules\Admin\Config;

use CodeIgniter\Config\BaseConfig;

class Admin extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Admin gateway
     * --------------------------------------------------------------------------
     * Defines a base route for all admin pages
     */
    public string $gateway = 'cp-admin';
}
