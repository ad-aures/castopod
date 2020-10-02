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
        'category_id',
        'parental_advisory',
        'owner_name',
        'owner_email',
        'publisher',
        'type',
        'copyright',
        'block',
        'complete',
        'created_by',
        'updated_by',
        'imported_feed_url',
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
        'category_id' => 'required',
        'owner_email' => 'required|valid_email',
        'type' => 'required',
        'created_by' => 'required',
        'updated_by' => 'required',
    ];
    protected $validationMessages = [];

    // clear cache before update if by any chance, the podcast name changes, and so will the podcast link
    protected $beforeUpdate = ['clearCache'];
    protected $beforeDelete = ['clearCache'];

    public function getPodcastByName($podcastName)
    {
        if (!($found = cache("podcast@{$podcastName}"))) {
            $found = $this->where('name', $podcastName)->first();

            cache()->save("podcast@{$podcastName}", $found, DECADE);
        }

        return $found;
    }

    public function getPodcastById($podcastId)
    {
        if (!($found = cache("podcast{$podcastId}"))) {
            $found = $this->find($podcastId);

            cache()->save("podcast{$podcastId}", $found, DECADE);
        }

        return $found;
    }

    /**
     *  Gets all the podcasts a given user is contributing to
     *
     * @param int $userId
     *
     * @return \App\Entities\Podcast[] podcasts
     */
    public function getUserPodcasts($userId)
    {
        if (!($found = cache("user{$userId}_podcasts"))) {
            $found = $this->select('podcasts.*')
                ->join(
                    'users_podcasts',
                    'users_podcasts.podcast_id = podcasts.id'
                )
                ->where('users_podcasts.user_id', $userId)
                ->findAll();

            cache()->save("user{$userId}_podcasts", $found, DECADE);
        }

        return $found;
    }

    public function addPodcastContributor($userId, $podcastId, $groupId)
    {
        cache()->delete("podcast{$podcastId}_contributors");

        $data = [
            'user_id' => (int) $userId,
            'podcast_id' => (int) $podcastId,
            'group_id' => (int) $groupId,
        ];

        return $this->db->table('users_podcasts')->insert($data);
    }

    public function updatePodcastContributor($userId, $podcastId, $groupId)
    {
        cache()->delete("podcast{$podcastId}_contributors");

        return $this->db
            ->table('users_podcasts')
            ->where([
                'user_id' => (int) $userId,
                'podcast_id' => (int) $podcastId,
            ])
            ->update(['group_id' => $groupId]);
    }

    public function removePodcastContributor($userId, $podcastId)
    {
        cache()->delete("podcast{$podcastId}_contributors");

        return $this->db
            ->table('users_podcasts')
            ->where([
                'user_id' => $userId,
                'podcast_id' => $podcastId,
            ])
            ->delete();
    }

    public function getContributorGroupId($userId, $podcastId)
    {
        $user_podcast = $this->db
            ->table('users_podcasts')
            ->select('group_id')
            ->where([
                'user_id' => $userId,
                'podcast_id' => $podcastId,
            ])
            ->get()
            ->getResultObject();

        return (int) count($user_podcast) > 0
            ? $user_podcast[0]->group_id
            : false;
    }

    protected function clearCache(array $data)
    {
        $podcast = (new PodcastModel())->getPodcastById(
            is_array($data['id']) ? $data['id'][0] : $data['id']
        );

        // delete cache for rss feed and podcast pages
        cache()->delete(md5($podcast->feed_url));
        cache()->delete(md5($podcast->link));

        // clear cache for every podcast's episode page?
        foreach ($podcast->episodes as $episode) {
            cache()->delete(md5($episode->link));
        }

        // delete model requests cache
        cache()->delete("podcast{$podcast->id}");
        cache()->delete("podcast@{$podcast->name}");

        return $data;
    }
}
