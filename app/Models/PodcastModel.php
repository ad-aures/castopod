<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Actor;
use App\Entities\Podcast;
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
     * @var list<string>
     */
    protected $allowedFields = [
        'id',
        'guid',
        'title',
        'handle',
        'description_markdown',
        'description_html',
        'cover_id',
        'banner_id',
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
        'is_published_on_hubs',
        'is_premium_by_default',
        'published_at',
        'created_by',
        'updated_by',
    ];

    /**
     * @var class-string<Podcast>
     */
    protected $returnType = Podcast::class;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * @var array<string, string>
     */
    protected $validationRules = [
        'id'                   => 'permit_empty|is_natural_no_zero',
        'title'                => 'required',
        'handle'               => 'required|regex_match[/^[a-zA-Z0-9\_]{1,32}$/]|is_unique[podcasts.handle,id,{id}]',
        'description_markdown' => 'required',
        'cover_id'             => 'required',
        'language_code'        => 'required',
        'category_id'          => 'required',
        'owner_email'          => 'required|valid_email',
        'new_feed_url'         => 'valid_url_strict|permit_empty',
        'type'                 => 'required',
        'published_at'         => 'valid_date|permit_empty',
        'created_by'           => 'required',
        'updated_by'           => 'required',
    ];

    /**
     * @var list<string>
     */
    protected $beforeInsert = ['setPodcastGUID', 'createPodcastActor'];

    /**
     * @var list<string>
     */
    protected $afterInsert = ['setActorAvatar'];

    /**
     * @var list<string>
     */
    protected $afterUpdate = ['updatePodcastActor'];

    /**
     * clear cache before update if by any chance, the podcast name changes, so will the podcast link
     *
     * @var list<string>
     */
    protected $beforeUpdate = ['clearCache'];

    /**
     * @var list<string>
     */
    protected $beforeDelete = ['clearCache'];

    public function getPodcastByHandle(string $podcastHandle): ?Podcast
    {
        $cacheName = "podcast-{$podcastHandle}";
        if (! ($found = cache($cacheName))) {
            $found = $this->where('handle', $podcastHandle)
                ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
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
     * @return Podcast[]
     */
    public function getAllPodcasts(?string $orderBy = null): array
    {
        $prefix = $this->db->getPrefix();

        if ($orderBy === 'activity') {
            $this->builder()
                ->select('podcasts.*, MAX(`' . $prefix . 'fediverse_posts`.`published_at`) as max_published_at')
                ->join('fediverse_posts', 'fediverse_posts.actor_id = podcasts.actor_id', 'left')
                ->groupStart()
                ->where(
                    '`' . $prefix . 'fediverse_posts`.`published_at` <= UTC_TIMESTAMP()',
                    null,
                    false,
                )->orWhere('fediverse_posts.published_at')
                ->groupEnd()
                ->groupBy('podcasts.actor_id')
                ->orderBy('max_published_at', 'DESC');
        } elseif ($orderBy === 'created_desc') {
            $this->orderBy('created_at', 'DESC');
        } elseif ($orderBy === 'created_asc') {
            $this->orderBy('created_at', 'ASC');
        }

        return $this->where('`' . $prefix . 'podcasts`.`published_at` <= UTC_TIMESTAMP()', null, false)->findAll();
    }

    /**
     * Gets all the podcasts a given user is contributing to
     *
     * @param string[] $userPodcastIds
     * @return Podcast[] podcasts
     */
    public function getUserPodcasts(int $userId, array $userPodcastIds): array
    {
        $cacheName = "user{$userId}_podcasts";
        if (! ($found = cache($cacheName))) {
            $found = $userPodcastIds === [] ? [] : $this->whereIn('id', $userPodcastIds)
                ->findAll();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getContributorGroup(int $userId, int $podcastId): int | false
    {
        $userPodcast = $this->db
            ->table('auth_groups_users')
            ->select('user_id, group')
            ->where('user_id', $userId)
            ->like('group', "podcast#{$podcastId}")
            ->get()
            ->getResultObject();

        return $userPodcast !== []
            ? (int) $userPodcast[0]->group
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
                ->builder()
                ->select('YEAR(published_at) as year, count(*) as number_of_episodes')
                ->where([
                    'podcast_id'    => $podcastId,
                    'season_number' => null,
                ])
                ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
                ->groupBy('year')
                ->orderBy('year', 'DESC')
                ->get()
                ->getResultArray();

            $secondsToNextUnpublishedEpisode = $episodeModel->getSecondsToNextUnpublishedEpisode($podcastId);

            cache()
                ->save($cacheName, $found, $secondsToNextUnpublishedEpisode ?: DECADE);
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
                ->builder()
                ->select('season_number, count(*) as number_of_episodes')
                ->where([
                    'podcast_id'           => $podcastId,
                    'season_number is not' => null,
                ])
                ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
                ->groupBy('season_number')
                ->orderBy('season_number', 'ASC')
                ->get()
                ->getResultArray();

            $secondsToNextUnpublishedEpisode = $episodeModel->getSecondsToNextUnpublishedEpisode($podcastId);

            cache()
                ->save($cacheName, $found, $secondsToNextUnpublishedEpisode ?: DECADE);
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

            $secondsToNextUnpublishedEpisode = new EpisodeModel()
                ->getSecondsToNextUnpublishedEpisode($podcastId);

            cache()
                ->save($cacheName, $defaultQuery, $secondsToNextUnpublishedEpisode ?: DECADE);
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
        $podcast = new self()
            ->find((int) (is_array($data['id']) ? $data['id'][0] : $data['id']));

        // delete cache for users' podcasts
        cache()
            ->deleteMatching('user*podcasts');

        if ($podcast instanceof Podcast) {
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

    public function getFullTextMatchClauseForPodcasts(string $table, string $value): string
    {
        return '
                MATCH (
                    ' . $table . '.title ,
                    ' . $table . '.description_markdown,
                    ' . $table . '.handle,
                    ' . $table . '.location_name
                )
                AGAINST(' . $this->db->escape($value) . ')
            ';
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

        $actorId = new ActorModel()
            ->insert(
                [
                    'uri'           => url_to('podcast-activity', $username),
                    'username'      => $username,
                    'domain'        => $domain,
                    'private_key'   => $privatekey,
                    'public_key'    => $publickey,
                    'display_name'  => $data['data']['title'],
                    'summary'       => $data['data']['description_html'],
                    'inbox_url'     => url_to('inbox', $username),
                    'outbox_url'    => url_to('outbox', $username),
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
        $podcast = new self()
            ->find((int) (is_array($data['id']) ? $data['id'][0] : $data['id']));

        if ($podcast instanceof Podcast) {
            $podcastActor = new ActorModel()
                ->find($podcast->actor_id);

            if (! $podcastActor instanceof Actor) {
                return $data;
            }

            $podcastActor->avatar_image_url = $podcast->cover->federation_url;
            $podcastActor->avatar_image_mimetype = $podcast->cover->federation_mimetype;

            new ActorModel()
                ->update($podcast->actor_id, $podcastActor);
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
        $podcast = new self()
            ->find((int) (is_array($data['id']) ? $data['id'][0] : $data['id']));

        if ($podcast instanceof Podcast) {
            $actorModel = new ActorModel();
            $actor = $actorModel->getActorById($podcast->actor_id);

            if ($actor instanceof Actor) {
                // update values
                $actor->display_name = $podcast->title;
                $actor->summary = $podcast->description_html;
                $actor->avatar_image_url = $podcast->cover->federation_url;
                $actor->avatar_image_mimetype = $podcast->cover->federation_mimetype;
                $actor->cover_image_url = get_podcast_banner_url($podcast, 'federation');
                $actor->cover_image_mimetype = get_podcast_banner_mimetype($podcast, 'federation');

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
     * Sets the UUIDv5 for a podcast. For more information, see
     * https://podcastindex.org/namespace/1.0#guid
     *
     * @return mixed[]
     */
    protected function setPodcastGUID(array $data): array
    {
        if (! array_key_exists(
            'guid',
            $data['data'],
        ) || $data['data']['guid'] === null || $data['data']['guid'] === '') {
            $uuid = service('uuid');
            $feedUrl = url_to('podcast-rss-feed', $data['data']['handle']);
            // 'ead4c236-bf58-58c6-a2c6-a6b28d128cb6' is the uuid of the podcast namespace
            $data['data']['guid'] = $uuid->uuid5('ead4c236-bf58-58c6-a2c6-a6b28d128cb6', $feedUrl)->toString();
        }

        return $data;
    }
}
