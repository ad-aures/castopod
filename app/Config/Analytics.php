<?php

namespace Config;

use Analytics\Config\Analytics as AnalyticsBase;

class Analytics extends AnalyticsBase
{
    /**
     * --------------------------------------------------------------------
     * Route filters options
     * --------------------------------------------------------------------
     */
    public $routeFilters = [
        'analytics-full-data' => 'permission:podcasts-view,podcast-view',
        'analytics-data' => 'permission:podcasts-view,podcast-view',
        'analytics-filtered-data' => 'permission:podcasts-view,podcast-view',
    ];

    public function __construct()
    {
        parent::__construct();

        // set the analytics gateway behind the admin gateway.
        // Only logged in users should be able to view analytics
        $this->gateway = config('App')->adminGateway . '/analytics';
    }

    public function getEnclosureUrl($enclosureUri)
    {
        helper('media');

        return media_base_url($enclosureUri);
    }
}
