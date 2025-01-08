<?php

declare(strict_types=1);

/**
 * Class AnalyticsPodcastsByRegion Entity for AnalyticsPodcastsByRegion
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

/**
 * @property int $podcast_id
 * @property string $country_code
 * @property string|null $region_code
 * @property double|null $latitude
 * @property double|null $longitude
 * @property Time $date
 * @property int $hits
 * @property Time $created_at
 * @property Time $updated_at
 */
class AnalyticsPodcastsByRegion extends Entity
{
    /**
     * @var list<string>
     */
    protected $dates = ['date', 'created_at', 'updated_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'podcast_id'   => 'integer',
        'country_code' => 'string',
        'region_code'  => '?string',
        'latitude'     => '?double',
        'longitude'    => '?double',
        'hits'         => 'integer',
    ];

    public function getCountryCode(): string
    {
        return lang('Countries.' . $this->attributes['country_code']);
    }
}
