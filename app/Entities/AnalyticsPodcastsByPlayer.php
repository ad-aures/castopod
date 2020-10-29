<?php

/**
 * Class AnalyticsPodcastsByPlayer
 * Entity for AnalyticsPodcastsByPlayer
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity;

class AnalyticsPodcastsByPlayer extends Entity
{
    protected $casts = [
        'podcast_id' => 'integer',
        'app' => '?string',
        'device' => '?string',
        'os' => '?string',
        'is_bot' => 'boolean',
        'date' => 'datetime',
        'hits' => 'integer',
    ];
}
