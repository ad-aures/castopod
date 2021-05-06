<?php

/**
 * Class AnalyticsUnknownUseragentsModel
 * Model for analytics_unknown_useragents table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Models;

use Analytics\Entities\AnalyticsUnknownUseragents;
use CodeIgniter\Model;

class AnalyticsUnknownUseragentsModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'analytics_unknown_useragents';
    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var string
     */
    protected $returnType = AnalyticsUnknownUseragents::class;
    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = false;
}
