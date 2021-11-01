<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Podcast;
use CodeIgniter\Database\Query;
use CodeIgniter\HTTP\URI;
use CodeIgniter\Model;
use phpseclib\Crypt\RSA;

class PodcastModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'podcasts';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var string[]
     */
    protected $allowedFields = [
        'id',
        'guid',
        'title',
        'handle',
        'description_markdown',
        'description_html',
        'episode_description_footer_markdown',
        'episode_description_footer_html',
        'cover_path',
        'cover_mimetype',
        'banner_path',
        'banner_mimetype',
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
        'location_osm',
        'payment_pointer',
        'custom_rss',
        'partner_id',
        'partner_link_url',
        'partner_image_url',
        'created_by',
        'updated_by',
    ];

    /**
     * @var string
     */
    protected $returnType = Podcast::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = true;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * @var array<string, string>
     */
    protected $validationRules = [
        'title' => 'required',
        'handle' =>
            'required|regex_match[/^[a-zA-Z0-9\_]{1,32}$/]|is_unique[podcasts.handle,id,{id}]',
        'description_markdown' => 'required',
        'cover_path' => 'required',
        'language_code' => 'required',
        'category_id' => 'required',
        'owner_email' => 'required|valid_email',
        'type' => 'required',
        'created_by' => 'required',
        'updated_by' => 'required',
    ];

    /**
     * @var string[]
     */
    protected $beforeInsert = ['setPodcastGUID', 'createPodcastActor'];

    /**
     * @var string[]
     */
    protected $afterInsert = ['setActorAvatar'];

    /**
     * @var string[]
     */
    protected $afterUpdate = ['updatePodcastActor'];

    /**
     * clear cache before update if by any chance, the podcast name changes, so will the podcast link
     *
     * @var string[]
     */
    protected $beforeUpdate = ['clearCache'];

    /**
     * @var string[]
     */
    protected $beforeDelete = ['clearCache'];

    public function getPodcastByHandle(string $podcastHandle): ?Podcast
    {
        $cacheName = "podcast-{$podcastHandle}";
        if (! ($found = cache($cacheName))) {
            $found = $this->where('handle', $podcastHandle)
                ->first();
            cache()
                ->save("podcast-{$podcastHandle}", $found, DECADE);
        }

        return $found;
    }

    public function getPodcastById(int $podcastId): ?Podcast
    {
        $cacheName = "podcast#{$podcastId}";
        if (! ($found = cache($cacheName))) {
            $found = $this->find($podcastId);

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getPodcastByActorId(int $actorId): ?Podcast
    {
        $cacheName = "podcast_actor#{$actorId}";
        if (! ($found = cache($cacheName))) {
            $found = $this->where('actor_id', $actorId)
                ->first();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * Gets all the podcasts a given user is contributing to
     *
     * @return Podcast[] podcasts
     */
    public function getUserPodcasts(int $userId): array
    {
        $cacheName = "user{$userId}_podcasts";
        if (! ($found = cache($cacheName))) {
            $found = $this->select('podcasts.*')
                ->join('podcasts_users', 'podcasts_users.podcast_id = podcasts.id')
                ->where('podcasts_users.user_id', $userId)
                ->findAll();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function addPodcastContributor(int $userId, int $podcastId, int $groupId): Query | bool
    {
        cache()->delete("podcast#{$podcastId}_contributors");

        $data = [
            'user_id' => $userId,
            'podcast_id' => $podcastId,
            'group_id' => $groupId,
        ];

        return $this->db->table('podcasts_users')
            ->insert($data);
    }

    public function updatePodcastContributor(int $userId, int $podcastId, int $groupId): bool
    {
        cache()->delete("podcast#{$podcastId}_contributors");

        return $this->db
            ->table('podcasts_users')
            ->where([
                'user_id' => $userId,
                'podcast_id' => $podcastId,
            ])
            ->update([
                'group_id' => $groupId,
            ]);
    }

    public function removePodcastContributor(int $userId, int $podcastId): string | bool
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

    public function getContributorGroupId(int $userId, int | string $podcastId): int | false
    {
        if (! is_numeric($podcastId)) {
            // identifier is the podcast name, request must be a join
            $userPodcast = $this->db
                ->table('podcasts_users')
                ->select('group_id, user_id')
                ->join('podcasts', 'podcasts.id = podcasts_users.podcast_id')
                ->where([
                    'user_id' => $userId,
                    'handle' => $podcastId,
                ])
                ->get()
                ->getResultObject();
        } else {
            $userPodcast = $this->db
                ->table('podcasts_users')
                ->select('group_id')
                ->where([
                    'user_id' => $userId,
                    'podcast_id' => $podcastId,
                ])
                ->get()
                ->getResultObject();
        }

        return $userPodcast !== []
            ? (int) $userPodcast[0]->group_id
            : false;
    }

    /**
     * @return array<string, string>[]
     */
    public function getYears(int $podcastId): array
    {
        $cacheName = "podcast#{$podcastId}_years";
        if (! ($found = cache($cacheName))) {
            $episodeModel = new EpisodeModel();
            $found = $episodeModel
                ->select('YEAR(published_at) as year, count(*) as number_of_episodes')
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

            $secondsToNextUnpublishedEpisode = $episodeModel->getSecondsToNextUnpublishedEpisode($podcastId);

            cache()
                ->save(
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
     * @return array<string, string>[]
     */
    public function getSeasons(int $podcastId): array
    {
        $cacheName = "podcast#{$podcastId}_seasons";
        if (! ($found = cache($cacheName))) {
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

            $secondsToNextUnpublishedEpisode = $episodeModel->getSecondsToNextUnpublishedEpisode($podcastId);

            cache()
                ->save(
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
     * @return array<string, mixed>|null
     */
    public function getDefaultQuery(int $podcastId): ?array
    {
        $cacheName = "podcast#{$podcastId}_defaultQuery";
        if (! ($defaultQuery = cache($cacheName))) {
            $seasons = $this->getSeasons($podcastId);

            if ($seasons !== []) {
                // get latest season
                $defaultQuery = [
                    'type' => 'season',
                    'data' => end($seasons),
                ];
            } else {
                $years = $this->getYears($podcastId);
                $defaultQuery = $years === [] ? null : [
                    'type' => 'year',
                    'data' => $years[0],
                ];
            }

            $secondsToNextUnpublishedEpisode = (new EpisodeModel())->getSecondsToNextUnpublishedEpisode($podcastId);

            cache()
                ->save(
                    $cacheName,
                    $defaultQuery,
                    $secondsToNextUnpublishedEpisode ? $secondsToNextUnpublishedEpisode : DECADE
                );
        }
        return $defaultQuery;
    }

    /**
     * @param mixed[] $data
     *
     * @return mixed[]
     */
    public function clearCache(array $data): array
    {
        $podcast = (new self())->getPodcastById(is_array($data['id']) ? $data['id'][0] : $data['id']);

        if ($podcast !== null) {
            // delete cache all podcast pages
            cache()
                ->deleteMatching("page_podcast#{$podcast->id}*");

            // delete all cache for podcast actor
            cache()
                ->deleteMatching(config('Fediverse') ->cachePrefix . "actor#{$podcast->actor_id}*");

            // delete model requests cache, includes feed / query / episode lists, etc.
            cache()
                ->deleteMatching("podcast#{$podcast->id}*");
            cache()
                ->delete("podcast-{$podcast->handle}");
        }

        // clear cache for every credit page
        cache()
            ->deleteMatching('page_credits_*');

        return $data;
    }

    /**
     * Creates an actor linked to the podcast (Triggered before insert)
     *
     * @param mixed[] $data
     *
     * @return mixed[]
     */
    protected function createPodcastActor(array $data): array
    {
        $rsa = new RSA();
        $rsa->setHash('sha256');

        // extracts $privatekey and $publickey variables
        $rsaKey = $rsa->createKey(2048);
        $privatekey = $rsaKey['privatekey'];
        $publickey = $rsaKey['publickey'];

        $url = new URI(base_url());
        $username = $data['data']['handle'];
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

    /**
     * @param mixed[] $data
     *
     * @return mixed[]
     */
    protected function setActorAvatar(array $data): array
    {
        $podcast = (new self())->getPodcastById(is_array($data['id']) ? $data['id'][0] : $data['id']);

        if ($podcast !== null) {
            $podcastActor = (new ActorModel())->find($podcast->actor_id);

            if ($podcastActor) {
                $podcastActor->avatar_image_url = $podcast->cover->thumbnail_url;
                $podcastActor->avatar_image_mimetype = $podcast->cover_mimetype;

                (new ActorModel())->update($podcast->actor_id, $podcastActor);
            }
        }
        return $data;
    }

    /**
     * @param mixed[] $data
     *
     * @return mixed[]
     */
    protected function updatePodcastActor(array $data): array
    {
        $podcast = (new self())->getPodcastById(is_array($data['id']) ? $data['id'][0] : $data['id']);

        if ($podcast !== null) {
            $actorModel = new ActorModel();
            $actor = $actorModel->getActorById($podcast->actor_id);

            if ($actor !== null) {
                // update values
                $actor->display_name = $podcast->title;
                $actor->summary = $podcast->description_html;
                $actor->avatar_image_url = $podcast->cover->thumbnail_url;
                $actor->avatar_image_mimetype = $podcast->cover->mimetype;
                $actor->cover_image_url = $podcast->banner->large_url;
                $actor->cover_image_mimetype = $podcast->banner->mimetype;

                if ($actor->hasChanged()) {
                    $actorModel->update($actor->id, $actor);
                }
            }
        }

        return $data;
    }

    /**
     * @param mixed[] $data
     *
     * @return mixed[]
     */
    protected function setPodcastGUID(array $data): array
    {
        if (! array_key_exists('guid', $data['data']) || $data['data']['guid'] === null) {
            helper('misc');
            $data['data']['guid'] = podcast_uuid(url_to('podcast_feed', $data['data']['handle']));
        }

        return $data;
    }
}
