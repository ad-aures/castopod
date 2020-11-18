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
        'description_markdown',
        'description_html',
        'episode_description_footer_markdown',
        'episode_description_footer_html',
        'image_uri',
        'language_code',
        'category_id',
        'parental_advisory',
        'owner_name',
        'owner_email',
        'publisher',
        'type',
        'copyright',
        'imported_feed_url',
        'new_feed_url',
        'is_blocked',
        'is_completed',
        'is_locked',
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
        'description_markdown' => 'required',
        'image_uri' => 'required',
        'language_code' => 'required',
        'category_id' => 'required',
        'owner_email' => 'required|valid_email',
        'type' => 'required',
        'created_by' => 'required',
        'updated_by' => 'required',
    ];
    protected $validationMessages = [];

    // clear cache before update if by any chance, the podcast name changes, so will the podcast link
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
                    'podcasts_users',
                    'podcasts_users.podcast_id = podcasts.id'
                )
                ->where('podcasts_users.user_id', $userId)
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

        return $this->db->table('podcasts_users')->insert($data);
    }

    public function updatePodcastContributor($userId, $podcastId, $groupId)
    {
        cache()->delete("podcast{$podcastId}_contributors");

        return $this->db
            ->table('podcasts_users')
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
            ->table('podcasts_users')
            ->where([
                'user_id' => $userId,
                'podcast_id' => $podcastId,
            ])
            ->delete();
    }

    public function getContributorGroupId($userId, $podcastId)
    {
        $user_podcast = $this->db
            ->table('podcasts_users')
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
        $supportedLocales = config('App')->supportedLocales;

        // delete cache for rss feed and podcast pages
        cache()->delete("podcast{$podcast->id}_feed");
        foreach (\Opawg\UserAgentsPhp\UserAgentsRSS::$db as $service) {
            cache()->delete("podcast{$podcast->id}_feed_{$service['slug']}");
        }

        // delete model requests cache
        cache()->delete("podcast{$podcast->id}");
        cache()->delete("podcast@{$podcast->name}");

        // clear cache for every localized podcast episode page
        foreach ($podcast->episodes as $episode) {
            foreach ($supportedLocales as $locale) {
                cache()->delete(
                    "page_podcast{$podcast->id}_episode{$episode->id}_{$locale}"
                );
            }
        }

        // delete episode lists cache per year / season
        // and localized pages
        $episodeModel = new EpisodeModel();
        $years = $episodeModel->getYears($podcast->id);
        $seasons = $episodeModel->getSeasons($podcast->id);

        foreach ($years as $year) {
            cache()->delete("podcast{$podcast->id}_{$year['year']}_episodes");
            foreach ($supportedLocales as $locale) {
                cache()->delete(
                    "page_podcast{$podcast->id}_{$year['year']}_{$locale}"
                );
            }
        }
        foreach ($seasons as $season) {
            cache()->delete(
                "podcast{$podcast->id}_season{$season['season_number']}_episodes"
            );
            foreach ($supportedLocales as $locale) {
                cache()->delete(
                    "page_podcast{$podcast->id}_season{$season['season_number']}_{$locale}"
                );
            }
        }

        // delete query cache
        cache()->delete("podcast{$podcast->id}_defaultQuery");
        cache()->delete("podcast{$podcast->id}_years");
        cache()->delete("podcast{$podcast->id}_seasons");

        return $data;
    }
}
