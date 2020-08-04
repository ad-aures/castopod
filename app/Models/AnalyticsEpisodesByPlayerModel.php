<?php

/**
 * Class AnalyticsEpisodesByPlayerModel
 * Model for analytics_episodes_by_player table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class AnalyticsEpisodesByPlayerModel extends Model
{
    protected $table = 'analytics_episodes_by_player';
    protected $primaryKey = 'id';

    protected $allowedFields = [];

    protected $returnType = \App\Entities\AnalyticsEpisodesByPlayer::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
}
