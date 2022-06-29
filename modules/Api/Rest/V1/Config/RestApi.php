<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Config;

use CodeIgniter\Config\BaseConfig;

class RestApi extends BaseConfig
{
    /**
     * Flag to enable or disable the Rest API.
     *
     * Disabled by default.
     */
    public bool $enabled = false;

    /**
     * --------------------------------------------------------------------------
     * Rest API gateway
     * --------------------------------------------------------------------------
     * Defines a base route for all API pages
     */
    public string $gateway = 'api/rest/v1/';
}
