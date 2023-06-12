<?php

declare(strict_types=1);

/**
 * Class AnalyticsPodcastsByCountry Entity for AnalyticsPodcastsByCountry
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int $podcast_id
 * @property string $country_code
 * @property string $labels
 * @property Time $date
 * @property int $hits
 * @property Time $created_at
 * @property Time $updated_at
 */
class AnalyticsPodcastsByCountry extends Entity
{
    /**
     * @var string[]
     */
    protected $dates = ['date', 'created_at', 'updated_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'podcast_id'   => 'integer',
        'country_code' => 'string',
        'hits'         => 'integer',
    ];

    public function getLabels(): string
    {
        return lang('Countries.' . $this->attributes['labels']);
    }
}
