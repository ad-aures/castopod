<?php

/**
 * Class AnalyticsPodcastsByService
 * Entity for AnalyticsPodcastsByService
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity;

class AnalyticsPodcastsByService extends Entity
{
    /**
     * @var string
     */
    protected $labels;

    protected $casts = [
        'podcast_id' => 'integer',
        'app' => '?string',
        'device' => '?string',
        'os' => '?string',
        'is_bot' => 'boolean',
        'date' => 'datetime',
        'hits' => 'integer',
    ];

    public function getLabels()
    {
        return \Opawg\UserAgentsPhp\UserAgentsRSS::getName(
            $this->attributes['labels']
        ) ?? $this->attributes['labels'];
    }
}
