<?php

/**
 * Class AnalyticsWebsiteByBrowser
 * Entity for AnalyticsWebsiteByBrowser
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Entities;

use datetime;
use CodeIgniter\Entity\Entity;

class AnalyticsWebsiteByBrowser extends Entity
{
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'podcast_id' => 'integer',
        'browser' => 'string',
        'date' => 'datetime',
        'hits' => 'integer',
    ];
}
