<?php

/**
 * Class AnalyticsPodcastsByHour
 * Entity for AnalyticsPodcastsByHour
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity;

class AnalyticsPodcastsByHour extends Entity
{
    protected $casts = [
        'podcast_id' => 'integer',
        'date' => 'datetime',
        'hour' => 'integer',
        'hits' => 'integer',
    ];
}
