<?php

declare(strict_types=1);

/**
 * Class AnalyticsUnknownUseragents Entity for AnalyticsUnknownUseragents
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

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
     * @var list<string>
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id'        => 'integer',
        'useragent' => 'integer',
        'hits'      => 'integer',
    ];
}
