<?php

declare(strict_types=1);

namespace ViewComponents\Config;

use CodeIgniter\Config\BaseConfig;

class ViewComponents extends BaseConfig
{
    public string $classComponentsNamespace = APP_NAMESPACE . '\View\Components';

    public string $classComponentsPath = APPPATH . 'View/Components';

    public string $componentsViewPath = APPPATH . 'Views/components';
}
