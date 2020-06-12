<?php
/**
 * Class class AnalyticsWebsiteByReferer
 * Entity for AnalyticsWebsiteByReferer
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */
namespace App\Entities;

use CodeIgniter\Entity;

class AnalyticsWebsiteByReferer extends Entity
{
    protected $casts = [
        'podcast_id' => 'integer',
        'referer' => 'string',
        'date' => 'datetime',
        'hits' => 'integer',
    ];
}
