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
     * --------------------------------------------------------------------------
     * Secret Salt
     * --------------------------------------------------------------------------
     *
     * The secret salt is a string of random characters that is used when hashing data.
     * Each Castopod instance has its own secret salt so keys will never be the same.
     *
     * Example:
     *    Z&|qECKBrwgaaD>~;U/tXG1U%tSe_oi5Tzy)h>}5NC2npSrjvM0w_Q>cs=0o=H]*
     */
    public string $salt = '';

    /**
     * get the full audio file url
     *
     * @param string|string[] $audioPath
     */
    public function getAudioUrl(string | array $audioPath): string
    {
        helper('media');

        return media_base_url($audioPath);
    }
}
