<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class UserPodcastModel extends Model
{
    protected $table = 'users_podcasts';
    protected $primaryKey = 'id';

    protected $allowedFields = ['user_id', 'podcast_id'];

    protected $returnType = 'App\Entities\UserPodcast';
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
}
