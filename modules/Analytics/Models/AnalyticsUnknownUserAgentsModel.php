<?php

declare(strict_types=1);

/**
 * Class AnalyticsUnknownUseragentsModel Model for analytics_unknown_useragents table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Models;

use CodeIgniter\Model;
use Modules\Analytics\Entities\AnalyticsUnknownUserAgent;

class AnalyticsUnknownUserAgentsModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'analytics_unknown_useragents';

    /**
     * @var class-string<AnalyticsUnknownUserAgent>
     */
    protected $returnType = AnalyticsUnknownUserAgent::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = false;

    /**
     * @return mixed[]
     */
    public function getUserAgents(int $lastKnownId = 0): array
    {
        return $this->where('id >', $lastKnownId)
            ->findAll();
    }
}
