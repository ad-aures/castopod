<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class EpisodeModel extends Model
{
    protected $table = 'episodes';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'podcast_id',
        'title',
        'slug',
        'enclosure_url',
        'enclosure_length',
        'enclosure_type',
        'guid',
        'pub_date',
        'description',
        'duration',
        'image',
        'explicit',
        'number',
        'season_number',
        'type',
        'block',
    ];

    protected $returnType = 'App\Entities\Episode';
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;
}
