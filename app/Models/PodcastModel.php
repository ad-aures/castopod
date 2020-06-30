<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class PodcastModel extends Model
{
    protected $table = 'podcasts';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'title',
        'name',
        'description',
        'episode_description_footer',
        'image_uri',
        'language',
        'category',
        'explicit',
        'author_name',
        'author_email',
        'owner_name',
        'owner_email',
        'type',
        'copyright',
        'block',
        'complete',
        'custom_html_head',
    ];

    protected $returnType = 'App\Entities\Podcast';
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $afterInsert = ['clearPodcastFeedCache'];
    protected $afterUpdate = ['clearPodcastFeedCache'];

    protected function clearPodcastFeedCache(array $data)
    {
        $podcast = $this->find(
            is_array($data['id']) ? $data['id'][0] : $data['id']
        );

        $cache = \Config\Services::cache();

        $cache->delete(md5($podcast->feed_url));
    }
}
