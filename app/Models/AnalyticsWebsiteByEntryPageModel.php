<?php

/**
 * Class AnalyticsWebsiteByEntryPageModel
 * Model for analytics_website_by_entry_page table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class AnalyticsWebsiteByEntryPageModel extends Model
{
    protected $table = 'analytics_website_by_entry_page';

    protected $allowedFields = [];

    protected $returnType = \App\Entities\AnalyticsWebsiteByEntryPage::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
}
