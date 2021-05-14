<?php

/**
 * Class AnalyticsUnknownUseragents
 * Entity for AnalyticsUnknownUseragents
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int $id
 * @property int $useragent
 * @property int $hits
 * @property Time $created_at
 * @property Time $updated_at
 */
class AnalyticsUnknownUserAgent extends Entity
{
    /**
     * @var string[]
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'useragent' => 'integer',
        'hits' => 'integer',
    ];
}
