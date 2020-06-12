<?php
/**
 * Class AnalyticsEpisodesByCountry
 * Entity for AnalyticsEpisodesByCountry
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */
namespace App\Entities;

use CodeIgniter\Entity;

class AnalyticsEpisodesByCountry extends Entity
{
    protected $casts = [
        'podcast_id' => 'integer',
        'episode_id' => 'integer',
        'country_code' => 'string',
        'date' => 'datetime',
        'hits' => 'integer',
    ];
}
