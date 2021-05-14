<?php

namespace Analytics\Config;

use CodeIgniter\Config\BaseConfig;

class Analytics extends BaseConfig
{
    /**
     * Gateway to analytic routes.
     * By default, all analytics routes will be under `/analytics` path
     *
     * @var string
     */
    public $gateway = 'analytics';

    /**
     * --------------------------------------------------------------------
     * Route filters options
     * --------------------------------------------------------------------
     * @var array<string, string>
     */
    public $routeFilters = [
        'analytics-full-data' => '',
        'analytics-data' => '',
        'analytics-filtered-data' => '',
    ];

    /**
     * get the full audio file
     *
     * @param string|string[] $audioFilePath
     */
    public function getAudioFileUrl(string|array $audioFilePath): string
    {
        return base_url($audioFilePath);
    }
}
