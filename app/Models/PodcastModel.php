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
        'owner_name',
        'owner_email',
        'author',
        'type',
        'copyright',
        'block',
        'complete',
        'custom_html_head',
        'created_by',
        'updated_by',
    ];

    protected $returnType = \App\Entities\Podcast::class;
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $validationRules = [
        'title' => 'required',
        'name' =>
            'required|regex_match[/^[a-zA-Z0-9\_]{1,191}$/]|is_unique[podcasts.name,id,{id}]',
        'description' => 'required',
        'image_uri' => 'required',
        'language' => 'required',
        'category' => 'required',
        'owner_name' => 'required',
        'owner_email' => 'required|valid_email',
        'type' => 'required',
        'created_by' => 'required',
        'updated_by' => 'required',
    ];
    protected $validationMessages = [];

    // clear cache before update if by any chance, the podcast name changes, and so will the podcast link
    protected $beforeUpdate = ['clearCache'];
    protected $beforeDelete = ['clearCache'];

    /**
     *  Gets all the podcasts a given user is contributing to
     *
     * @param int $user_id
     *
     * @return \App\Entities\Podcast[] podcasts
     */
    public function getUserPodcasts($user_id)
    {
        return $this->select('podcasts.*')
            ->join('users_podcasts', 'users_podcasts.podcast_id = podcasts.id')
            ->where('users_podcasts.user_id', $user_id)
            ->findAll();
    }

    public function addPodcastContributor($user_id, $podcast_id, $group_id)
    {
        $data = [
            'user_id' => (int) $user_id,
            'podcast_id' => (int) $podcast_id,
            'group_id' => (int) $group_id,
        ];

        return $this->db->table('users_podcasts')->insert($data);
    }

    public function updatePodcastContributor($user_id, $podcast_id, $group_id)
    {
        return $this->db
            ->table('users_podcasts')
            ->where([
                'user_id' => (int) $user_id,
                'podcast_id' => (int) $podcast_id,
            ])
            ->update(['group_id' => $group_id]);
    }

    public function removePodcastContributor($user_id, $podcast_id)
    {
        return $this->db
            ->table('users_podcasts')
            ->where([
                'user_id' => $user_id,
                'podcast_id' => $podcast_id,
            ])
            ->delete();
    }

    public function getContributorGroupId($user_id, $podcast_id)
    {
        // TODO: return only the group id
        $user_podcast = $this->db
            ->table('users_podcasts')
            ->select('group_id')
            ->where([
                'user_id' => $user_id,
                'podcast_id' => $podcast_id,
            ])
            ->get()
            ->getResultObject();

        return (int) count($user_podcast) > 0
            ? $user_podcast[0]->group_id
            : false;
    }

    protected function clearCache(array $data)
    {
        $podcast = (new PodcastModel())->find(
            is_array($data['id']) ? $data['id'][0] : $data['id']
        );

        // delete cache for rss feed and podcast pages
        cache()->delete(md5($podcast->feed_url));
        cache()->delete(md5($podcast->link));

        // clear cache for every podcast's episode page?
        foreach ($podcast->episodes as $episode) {
            cache()->delete(md5($episode->link));
        }

        return $data;
    }
}
