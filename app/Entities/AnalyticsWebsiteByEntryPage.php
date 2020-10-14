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
        'entry_page' => '?string',
        'date' => 'datetime',
        'hits' => 'integer',
    ];

    public function getLabels()
    {
        $split = explode('/', $this->attributes['labels']);
        return $split[count($split) - 1];
    }
}
