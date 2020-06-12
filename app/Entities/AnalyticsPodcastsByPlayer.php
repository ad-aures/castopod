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
        'player' => 'string',
        'date' => 'datetime',
        'hits' => 'integer',
    ];
}
