<?php

/**
 * Class AnalyticsPodcastsByCountry
 * Entity for AnalyticsPodcastsByCountry
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Entities;

use CodeIgniter\Entity;

class AnalyticsPodcastsByCountry extends Entity
{
    /**
     * @var string
     */
    protected $labels;

    protected $casts = [
        'podcast_id' => 'integer',
        'country_code' => 'string',
        'date' => 'datetime',
        'hits' => 'integer',
    ];

    public function getLabels()
    {
        return lang('Countries.' . $this->attributes['labels']);
    }
}
