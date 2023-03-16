<?php

declare(strict_types=1);

namespace Modules\Analytics\Config;

use App\Entities\Episode;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\HTTP\URI;
use Modules\Analytics\OP3;

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
        'analytics-full-data' => 'permission:podcast#.view',
        'analytics-data' => 'permission:podcast#.view',
        'analytics-filtered-data' => 'permission:podcast#.view',
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
     * --------------------------------------------------------------------------
     * The Open Podcast Prefix Project Config
     * --------------------------------------------------------------------------
     *
     * @var array<string, string>
     */
    public array $OP3 = [
        'host' => 'https://op3.dev/',
    ];

    public bool $enableOP3 = false;

    /**
     * get the full audio file url
     */
    public function getAudioUrl(Episode $episode, array $params): string
    {
        $audioFileURI = new URI(service('file_manager')->getUrl($episode->audio->file_key));
        $audioFileURI->setQueryArray($params);

        // Wrap episode url with OP3 if episode is public and OP3 is enabled on this podcast
        if (! $episode->is_premium && service('settings')->get(
            'Analytics.enableOP3',
            'podcast:' . $episode->podcast_id
        )) {
            $op3 = new OP3($this->OP3);
            $audioFileURI = new URI($op3->wrap($audioFileURI, $episode));
        }

        return (string) $audioFileURI;
    }
}
