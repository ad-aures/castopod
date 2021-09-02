<?php

declare(strict_types=1);

namespace Config;

use ViewComponents\Config\ViewComponents as ViewComponentsConfig;

class ViewComponents extends ViewComponentsConfig
{
    /**
     * @var string[]
     */
    public array $lookupPaths = [
        ROOTPATH . 'themes/cp_app/',
        ROOTPATH . 'themes/cp_admin/',
        ROOTPATH . 'themes/cp_auth/',
        ROOTPATH . 'themes/cp_install/',
    ];
}
