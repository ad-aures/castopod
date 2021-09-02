<?php

declare(strict_types=1);

namespace Config;

use ViewComponents\Config\ViewComponents as ViewComponentsConfig;

class ViewComponents extends ViewComponentsConfig
{
    /**
     * @var array<string, string>
     */
    public array $lookupModules = [
        APP_NAMESPACE => APPPATH,
        'Modules\Admin' => ROOTPATH . 'modules/Admin/',
        'Modules\Auth' => ROOTPATH . 'modules/Auth/',
        'Modules\Analytics' => ROOTPATH . 'modules/Analytics/',
        'Modules\Install' => ROOTPATH . 'modules/Install/',
        'Modules\Fediverse' => ROOTPATH . 'modules/Fediverse/',
    ];
}
