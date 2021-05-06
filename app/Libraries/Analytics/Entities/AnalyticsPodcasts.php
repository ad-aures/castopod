<?php

/**
 * Class AnalyticsPodcasts
 * Entity for AnalyticsPodcasts
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Entities;

use datetime;
use CodeIgniter\Entity\Entity;

class AnalyticsPodcasts extends Entity
{
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'podcast_id' => 'integer',
        'date' => 'datetime',
        'duration' => 'integer',
        'bandwidth' => 'integer',
        'unique_listeners' => 'integer',
        'hits' => 'integer',
    ];
}
