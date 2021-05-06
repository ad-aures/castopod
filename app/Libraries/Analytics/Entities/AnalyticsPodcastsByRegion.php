<?php

/**
 * Class AnalyticsPodcastsByRegion
 * Entity for AnalyticsPodcastsByRegion
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Entities;

use datetime;
use CodeIgniter\Entity\Entity;

class AnalyticsPodcastsByRegion extends Entity
{
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'podcast_id' => 'integer',
        'country_code' => 'string',
        'region_code' => '?string',
        'latitude' => '?float',
        'longitude' => '?float',
        'date' => 'datetime',
        'hits' => 'integer',
    ];

    public function getCountryCode()
    {
        return lang('Countries.' . $this->attributes['country_code']);
    }
}
