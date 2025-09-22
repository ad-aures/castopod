<?php

declare(strict_types=1);

namespace Modules\Plugins\Config;

use Castopod\PluginsManager\PluginsManager;
use CodeIgniter\Config\BaseService;
use Modules\Plugins\Core\Plugins;

class Services extends BaseService
{
    public static function plugins(bool $getShared = true): Plugins
    {
        if ($getShared) {
            return self::getSharedInstance('plugins');
        }

        $config = config('Plugins');

        return new Plugins($config);
    }

    /**
     * Castopod Plugins Manager (cpm)
     */
    public static function cpm(bool $getShared = true): PluginsManager
    {
        if ($getShared) {
            return self::getSharedInstance('cpm');
        }

        $config = config('Plugins');

        return new PluginsManager($config->repositoryUrl, WRITEPATH, $config->folder, WRITEPATH . 'temp');
    }
}
