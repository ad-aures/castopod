<?php

declare(strict_types=1);

namespace Config;

use Analytics\Config\Analytics as AnalyticsBase;

class Analytics extends AnalyticsBase
{
    /**
     * --------------------------------------------------------------------
     * Route filters options
     * --------------------------------------------------------------------
     */
    public array $routeFilters = [
        'analytics-full-data' => 'permission:podcasts-view,podcast-view',
        'analytics-data' => 'permission:podcasts-view,podcast-view',
        'analytics-filtered-data' => 'permission:podcasts-view,podcast-view',
    ];

    public function __construct()
    {
        parent::__construct();

        // set the analytics gateway behind the admin gateway.
        // Only logged in users should be able to view analytics
        $this->gateway = config('App')
            ->adminGateway . '/analytics';
    }

    /**
     * get the full audio file url
     *
     * @param string|string[] $audioFilePath
     */
    public function getAudioFileUrl(string|array $audioFilePath): string
    {
        helper('media');

        return media_base_url($audioFilePath);
    }
}
