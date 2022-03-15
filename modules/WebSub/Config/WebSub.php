<?php

declare(strict_types=1);

namespace Modules\WebSub\Config;

use CodeIgniter\Config\BaseConfig;

class WebSub extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Hubs to ping
     * --------------------------------------------------------------------------
     * @var string[]
     */
    public array $hubs = [
        'https://pubsubhubbub.appspot.com/',
        'https://pubsubhubbub.superfeedr.com/',
        'https://websubhub.com/hub',
        'https://switchboard.p3k.io/',
    ];
}
