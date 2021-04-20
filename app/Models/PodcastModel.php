<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use ActivityPub\Models\ActorModel;
use CodeIgniter\HTTP\URI;
use CodeIgniter\Model;
use phpseclib\Crypt\RSA;

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
        'image_mimetype',
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
        'location_name',
        'location_geo',
        'location_osmid',
        'payment_pointer',
        'custom_rss',
        'partner_id',
        'partner_link_url',
        'partner_image_url',
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

    protected $beforeInsert = ['createPodcastActor'];
    protected $afterInsert = ['setAvatarImageUrl'];
    protected $afterUpdate = ['updatePodcastActor'];

    // clear cache before update if by any chance, the podcast name changes, so will the podcast link
    protected $beforeUpdate = ['clearCache'];
    protected $beforeDelete = ['clearCache'];

    public function getPodcastByName($podcastName)
    {
        $cacheName = "podcast@{$podcastName}";
        if (!($found = cache($cacheName))) {
            $found = $this->where('name', $podcastName)->first();
            cache()->save("podcast@{$podcastName}", $found, DECADE);
        }

        return $found;
    }

    public function getPodcastById($podcastId)
    {
        $cacheName = "podcast#{$podcastId}";
        if (!($found = cache($cacheName))) {
            $found = $this->find($podcastId);

            cache()->save($cacheName, $found, DECADE);
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
        $cacheName = "user{$userId}_podcasts";
        if (!($found = cache($cacheName))) {
            $found = $this->select('podcasts.*')
                ->join(
                    'podcasts_users',
                    'podcasts_users.podcast_id = podcasts.id',
                )
                ->where('podcasts_users.user_id', $userId)
                ->findAll();

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function addPodcastContributor($userId, $podcastId, $groupId)
    {
        cache()->delete("podcast#{$podcastId}_contributors");

        $data = [
            'user_id' => (int) $userId,
            'podcast_id' => (int) $podcastId,
            'group_id' => (int) $groupId,
        ];

        return $this->db->table('podcasts_users')->insert($data);
    }

    public function updatePodcastContributor($userId, $podcastId, $groupId)
    {
        cache()->delete("podcast#{$podcastId}_contributors");

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
        cache()->delete("podcast#{$podcastId}_contributors");

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
        if (!is_numeric($podcastId)) {
            // identifier is the podcast name, request must be a join
            $user_podcast = $this->db
                ->table('podcasts_users')
                ->select('group_id', 'user_id')
                ->join('podcasts', 'podcasts.id = podcasts_users.podcast_id')
                ->where([
                    'user_id' => $userId,
                    'name' => $podcastId,
                ])
                ->get()
                ->getResultObject();
        } else {
            $user_podcast = $this->db
                ->table('podcasts_users')
                ->select('group_id')
                ->where([
                    'user_id' => $userId,
                    'podcast_id' => $podcastId,
                ])
                ->get()
                ->getResultObject();
        }

        return (int) count($user_podcast) > 0
            ? $user_podcast[0]->group_id
            : false;
    }

    public function getYears(int $podcastId): array
    {
        $cacheName = "podcast#{$podcastId}_years";
        if (!($found = cache($cacheName))) {
            $episodeModel = new EpisodeModel();
            $found = $episodeModel
                ->select(
                    'YEAR(published_at) as year, count(*) as number_of_episodes',
                )
                ->where([
                    'podcast_id' => $podcastId,
                    'season_number' => null,
                    $episodeModel->deletedField => null,
                ])
                ->where('`published_at` <= NOW()', null, false)
                ->groupBy('year')
                ->orderBy('year', 'DESC')
                ->get()
                ->getResultArray();

            $secondsToNextUnpublishedEpisode = $episodeModel->getSecondsToNextUnpublishedEpisode(
                $podcastId,
            );

            cache()->save(
                $cacheName,
                $found,
                $secondsToNextUnpublishedEpisode
                    ? $secondsToNextUnpublishedEpisode
                    : DECADE,
            );
        }

        return $found;
    }

    public function getSeasons(int $podcastId): array
    {
        $cacheName = "podcast#{$podcastId}_seasons";
        if (!($found = cache($cacheName))) {
            $episodeModel = new EpisodeModel();
            $found = $episodeModel
                ->select('season_number, count(*) as number_of_episodes')
                ->where([
                    'podcast_id' => $podcastId,
                    'season_number is not' => null,
                    $episodeModel->deletedField => null,
                ])
                ->where('`published_at` <= NOW()', null, false)
                ->groupBy('season_number')
                ->orderBy('season_number', 'ASC')
                ->get()
                ->getResultArray();

            $secondsToNextUnpublishedEpisode = $episodeModel->getSecondsToNextUnpublishedEpisode(
                $podcastId,
            );

            cache()->save(
                $cacheName,
                $found,
                $secondsToNextUnpublishedEpisode
                    ? $secondsToNextUnpublishedEpisode
                    : DECADE,
            );
        }

        return $found;
    }

    /**
     * Returns the default query for displaying the episode list on the podcast page
     *
     * @param int $podcastId
     *
     * @return array|null
     */
    public function getDefaultQuery(int $podcastId)
    {
        $cacheName = "podcast#{$podcastId}_defaultQuery";
        if (!($defaultQuery = cache($cacheName))) {
            $seasons = $this->getSeasons($podcastId);

            if (!empty($seasons)) {
                // get latest season
                $defaultQuery = ['type' => 'season', 'data' => end($seasons)];
            } else {
                $years = $this->getYears($podcastId);
                if (!empty($years)) {
                    // get most recent year
                    $defaultQuery = ['type' => 'year', 'data' => $years[0]];
                } else {
                    $defaultQuery = null;
                }
            }

            cache()->save($cacheName, $defaultQuery, DECADE);
        }
        return $defaultQuery;
    }

    public function clearCache(array $data)
    {
        $podcast = (new PodcastModel())->getPodcastById(
            is_array($data['id']) ? $data['id'][0] : $data['id'],
        );

        // delete cache all podcast pages
        cache()->deleteMatching("page_podcast#{$podcast->id}_*");

        // delete model requests cache, includes feed / query / episode lists, etc.
        cache()->deleteMatching("podcast#{$podcast->id}*");
        cache()->delete("podcast@{$podcast->name}");

        // clear cache for every credit page
        cache()->deleteMatching('page_credits_*');

        return $data;
    }

    /**
     * Creates an actor linked to the podcast
     * (Triggered before insert)
     *
     * @param array $data
     */
    protected function createPodcastActor(array $data)
    {
        $rsa = new RSA();
        $rsa->setHash('sha256');

        // extracts $privatekey and $publickey variables
        extract($rsa->createKey(2048));

        $url = new URI(base_url());
        $username = $data['data']['name'];
        $domain =
            $url->getHost() . ($url->getPort() ? ':' . $url->getPort() : '');

        $actorId = (new ActorModel())->insert(
            [
                'uri' => url_to('actor', $username),
                'username' => $username,
                'domain' => $domain,
                'private_key' => $privatekey,
                'public_key' => $publickey,
                'display_name' => $data['data']['title'],
                'summary' => $data['data']['description_html'],
                'inbox_url' => url_to('inbox', $username),
                'outbox_url' => url_to('outbox', $username),
                'followers_url' => url_to('followers', $username),
            ],
            true,
        );

        $data['data']['actor_id'] = $actorId;

        return $data;
    }

    protected function setAvatarImageUrl($data)
    {
        $podcast = (new PodcastModel())->getPodcastById(
            is_array($data['id']) ? $data['id'][0] : $data['id'],
        );

        $podcast->actor->avatar_image_url = $podcast->image->thumbnail_url;
        $podcast->actor->avatar_image_mimetype = $podcast->image_mimetype;

        (new ActorModel())->update($podcast->actor->id, $podcast->actor);

        return $data;
    }

    protected function updatePodcastActor(array $data)
    {
        $podcast = (new PodcastModel())->getPodcastById(
            is_array($data['id']) ? $data['id'][0] : $data['id'],
        );

        $actorModel = new ActorModel();
        $actor = $actorModel->find($podcast->actor_id);

        // update values
        $actor->display_name = $podcast->title;
        $actor->summary = $podcast->description_html;
        $actor->avatar_image_url = $podcast->image->thumbnail_url;
        $actor->avatar_image_mimetype = $podcast->image_mimetype;

        if ($actor->hasChanged()) {
            $actorModel->update($actor->id, $actor);
        }

        return $data;
    }
}
