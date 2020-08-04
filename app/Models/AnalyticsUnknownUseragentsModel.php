<?php

/**
 * Class AnalyticsUnknownUseragentsModel
 * Model for analytics_unknown_useragents table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class AnalyticsUnknownUseragentsModel extends Model
{
    protected $table = 'analytics_unknown_useragents';
    protected $primaryKey = 'id';

    protected $allowedFields = [];

    protected $returnType = \App\Entities\AnalyticsUnknownUseragents::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
}
