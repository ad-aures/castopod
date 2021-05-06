<?php

/**
 * Class AnalyticsPodcastsByEpisode
 * Entity for AnalyticsPodcastsByEpisode
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Entities;

use datetime;
use CodeIgniter\Entity\Entity;

class AnalyticsPodcastsByEpisode extends Entity
{
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'podcast_id' => 'integer',
        'episode_id' => 'integer',
        'date' => 'datetime',
        'hits' => 'integer',
    ];
}
