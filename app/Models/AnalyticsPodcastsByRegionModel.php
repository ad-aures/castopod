<?php

/**
 * Class AnalyticsPodcastsByRegionModel
 * Model for analytics_podcasts_by_region table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class AnalyticsPodcastsByRegionModel extends Model
{
    protected $table = 'analytics_podcasts_by_region';

    protected $allowedFields = [];

    protected $returnType = \App\Entities\AnalyticsPodcastsByRegion::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
}
