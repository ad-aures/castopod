<?php

declare(strict_types=1);

namespace Modules\Analytics\Config;

use CodeIgniter\Config\BaseConfig;

class Analytics extends BaseConfig
{
    /**
     * Gateway to analytic routes. By default, all analytics routes will be under `/analytics` path
     */
    public string $gateway = 'analytics';

    /**
     * --------------------------------------------------------------------
     * Route filters options
     * --------------------------------------------------------------------
     * @var array<string, string>
     */
    public array $routeFilters = [
        'analytics-full-data' => 'permission:podcasts-view,podcast-view',
        'analytics-data' => 'permission:podcasts-view,podcast-view',
        'analytics-filtered-data' => 'permission:podcasts-view,podcast-view',
    ];

    /**
     * get the full audio file url
     *
     * @param string|string[] $audioFilePath
     */
    public function getAudioFileUrl(string | array $audioFilePath): string
    {
        helper('media');

        return media_base_url($audioFilePath);
    }
}
