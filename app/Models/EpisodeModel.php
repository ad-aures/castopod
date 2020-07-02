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
        'enclosure_uri',
        'enclosure_length',
        'enclosure_type',
        'pub_date',
        'description',
        'duration',
        'image_uri',
        'explicit',
        'number',
        'season_number',
        'author_name',
        'author_email',
        'type',
        'block',
    ];

    protected $returnType = 'App\Entities\Episode';

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;

    protected $afterInsert = ['writeEnclosureMetadata', 'clearCache'];
    protected $afterUpdate = ['writeEnclosureMetadata', 'clearCache'];

    protected function writeEnclosureMetadata(array $data)
    {
        helper('id3');

        $episode = $this->find(
            is_array($data['id']) ? $data['id'][0] : $data['id']
        );

        write_enclosure_tags($episode);

        return $data;
    }

    protected function clearCache(array $data)
    {
        $episode = $this->find(
            is_array($data['id']) ? $data['id'][0] : $data['id']
        );

        $cache = \Config\Services::cache();

        // delete cache for rss feed, podcast and episode pages
        $cache->delete(md5($episode->podcast->feed_url));
        $cache->delete(md5($episode->podcast->link));
        $cache->delete(md5($episode->link));
    }
}
