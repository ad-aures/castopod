<?php


declare(strict_types=1);

namespace Modules\Api\Rest\V1\Config;

use CodeIgniter\Config\BaseConfig;

class Api extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Rest API gateway
     * --------------------------------------------------------------------------
     * Defines a base route for all API pages
     */
    public string $gateway = 'api/rest/v1/';
}
