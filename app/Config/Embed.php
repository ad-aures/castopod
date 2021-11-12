<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Embed extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Embeddable player config
     * --------------------------------------------------------------------------
     */
    public int $width = 600;

    public int $height = 144;
}
