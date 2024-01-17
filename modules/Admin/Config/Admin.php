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

    /**
     * Number of maximum ffmpeg processes to spawn in parallel when generating video clips. Processes are instance wide,
     * meaning that they are shared across all podcasts and episodes.
     */
    public int $videoClipWorkers = 1;
}
