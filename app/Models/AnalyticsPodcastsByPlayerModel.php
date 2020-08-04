<?php

/**
 * Class AnalyticsPodcastsByPlayerModel
 * Model for analytics_podcasts_by_player table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class AnalyticsPodcastsByPlayerModel extends Model
{
    protected $table = 'analytics_podcasts_by_player';
    protected $primaryKey = 'id';

    protected $allowedFields = [];

    protected $returnType = \App\Entities\AnalyticsPodcastsByPlayer::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
}
