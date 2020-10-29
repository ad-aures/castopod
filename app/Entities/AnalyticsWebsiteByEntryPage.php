<?php

/**
 * Class AnalyticsWebsiteByEntryPage
 * Entity for AnalyticsWebsiteByEntryPage
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity;

class AnalyticsWebsiteByEntryPage extends Entity
{
    protected $casts = [
        'podcast_id' => 'integer',
        'entry_page_url' => 'string',
        'date' => 'datetime',
        'hits' => 'integer',
    ];
}
