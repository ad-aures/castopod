<?php

declare(strict_types=1);

/**
 * Class AnalyticsUnknownUseragentsModel Model for analytics_unknown_useragents table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Models;

use Analytics\Entities\AnalyticsUnknownUserAgent;
use CodeIgniter\Model;

class AnalyticsUnknownUserAgentModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'analytics_unknown_useragents';

    /**
     * @var string
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
