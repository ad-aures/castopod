<?php
/**
 * Class AnalyticsEpisodesByPlayer
 * Entity for AnalyticsEpisodesByPlayer
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */
namespace App\Entities;

use CodeIgniter\Entity;

class AnalyticsEpisodesByPlayer extends Entity
{
    protected $casts = [
        'podcast_id' => 'integer',
        'episode_id' => 'integer',
        'player' => 'string',
        'date' => 'datetime',
        'hits' => 'integer',
    ];
}
