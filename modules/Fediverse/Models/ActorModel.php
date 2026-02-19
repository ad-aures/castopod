<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Models;

use CodeIgniter\Events\Events;
use CodeIgniter\Model;
use Modules\Fediverse\Entities\Actor;

class ActorModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'fediverse_actors';

    /**
     * @var list<string>
     */
    protected $allowedFields = [
        'id',
        'uri',
        'username',
        'domain',
        'display_name',
        'summary',
        'private_key',
        'public_key',
        'avatar_image_url',
        'avatar_image_mimetype',
        'cover_image_url',
        'cover_image_mimetype',
        'inbox_url',
        'outbox_url',
        'followers_url',
        'followers_count',
        'posts_count',
        'is_blocked',
    ];

    /**
     * @var class-string<Actor>
     */
    protected $returnType = Actor::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    public function getActorById(int $id): ?Actor
    {
        return $this->find($id);
    }

    /**
     * Looks for actor with username and domain, if no domain has been specified, the current host will be used
     */
    public function getActorByUsername(string $username, ?string $domain = null): ?Actor
    {
        // TODO: is there a better way?
        helper('fediverse');

        if (! $domain) {
            $domain = get_current_domain();
        }

        // remove colons for port if set
        $cacheDomain = str_replace(':', '', $domain);

        $cacheName = "actor-{$username}-{$cacheDomain}";
        if (! ($found = cache($cacheName))) {
            $found = $this->where([
                'username' => $username,
                'domain'   => $domain,
            ])->first();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getActorByUri(string $actorUri): ?Actor
    {
        $hashedActorUri = md5($actorUri);
        $cacheName =
            config('Fediverse')
                ->cachePrefix . "actor-{$hashedActorUri}";
        if (! ($found = cache($cacheName))) {
            $found = $this->where('uri', $actorUri)
                ->first();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * @return Actor[]
     */
    public function getFollowers(int $actorId): array
    {
        $cacheName =
            config('Fediverse')
                ->cachePrefix . "actor#{$actorId}_followers";
        if (! ($found = cache($cacheName))) {
            $found = $this->join('fediverse_follows', 'fediverse_follows.actor_id = id', 'inner')
                ->where('fediverse_follows.target_actor_id', $actorId)
                ->findAll();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * Check if an existing actor is blocked using its uri. Returns FALSE if the actor doesn't exist
     */
    public function isActorBlocked(string $actorUri): bool
    {
        if (($actor = $this->getActorByUri($actorUri)) instanceof Actor) {
            return $actor->is_blocked;
        }

        return false;
    }

    /**
     * Retrieves all blocked actors.
     *
     * @return Actor[]
     */
    public function getBlockedActors(): array
    {
        $cacheName = config('Fediverse')
            ->cachePrefix . 'blocked_actors';
        if (! ($found = cache($cacheName))) {
            $found = $this->where('is_blocked', 1)
                ->findAll();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function blockActor(int $actorId): void
    {
        $prefix = config('Fediverse')
            ->cachePrefix;
        cache()
            ->delete($prefix . 'blocked_actors');
        cache()
            ->deleteMatching($prefix . '*replies');

        $this->update($actorId, [
            'is_blocked' => 1,
        ]);

        Events::trigger('on_block_actor', $actorId);
    }

    public function unblockActor(int $actorId): void
    {
        $prefix = config('Fediverse')
            ->cachePrefix;
        cache()
            ->delete($prefix . 'blocked_actors');
        cache()
            ->deleteMatching($prefix . '*replies');

        $this->update($actorId, [
            'is_blocked' => 0,
        ]);

        Events::trigger('on_unblock_actor', $actorId);
    }

    public function getTotalLocalActors(): int
    {
        helper('fediverse');

        $cacheName = config('Fediverse')
            ->cachePrefix . 'blocked_actors';
        if (! ($found = cache($cacheName))) {
            $result = $this->builder()
                ->select('COUNT(*) as total_local_actors')
                ->where('domain', get_current_domain())
                ->get()
                ->getResultArray();

            $found = (int) $result[0]['total_local_actors'];

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getActiveLocalActors(int $lastNumberOfMonths = 1): int
    {
        helper('fediverse');

        $cacheName = config('Fediverse')
            ->cachePrefix . 'blocked_actors';
        if (! ($found = cache($cacheName))) {
            $tablePrefix = config('Database')
                ->default['DBPrefix'];
            $result = $this->builder()
                ->select('COUNT(DISTINCT `' . $tablePrefix . 'fediverse_actors`.`id`) as `total_active_actors`', false)
                ->join(
                    $tablePrefix . 'fediverse_posts',
                    $tablePrefix . 'fediverse_actors.id = ' . $tablePrefix . 'fediverse_posts.actor_id',
                    'left outer',
                )
                ->join(
                    $tablePrefix . 'fediverse_favourites',
                    $tablePrefix . 'fediverse_actors.id = ' . $tablePrefix . 'fediverse_favourites.actor_id',
                    'left outer',
                )
                ->where($tablePrefix . 'fediverse_actors.domain', get_current_domain())
                ->groupStart()
                ->where(
                    "`{$tablePrefix}fediverse_posts`.`created_at` >= UTC_TIMESTAMP() - INTERVAL {$lastNumberOfMonths} month",
                    null,
                    false,
                )
                ->orWhere(
                    "`{$tablePrefix}fediverse_favourites`.`created_at` >= UTC_TIMESTAMP() - INTERVAL {$lastNumberOfMonths} month",
                    null,
                    false,
                )
                ->groupEnd()
                ->get()
                ->getResultArray();

            $found = (int) $result[0]['total_active_actors'];

            cache()
                ->save($cacheName, $found, DAY);
        }

        return $found;
    }

    public function resetFollowersCount(): int | false
    {
        $actorsFollowersCount = $this->db->table('fediverse_follows')
            ->select('target_actor_id as id, COUNT(*) as `followers_count`')
            ->groupBy('id')
            ->get()
            ->getResultArray();

        if ($actorsFollowersCount !== []) {
            return $this->updateBatch($actorsFollowersCount, 'id');
        }

        return 0;
    }

    public function resetPostsCount(): int | false
    {
        $actorsFollowersCount = $this->db->table('fediverse_posts')
            ->select('actor_id as id, COUNT(*) as `posts_count`')
            ->where([
                'in_reply_to_id' => null,
            ])
            ->groupBy('actor_id')
            ->get()
            ->getResultArray();

        if ($actorsFollowersCount !== []) {
            return $this->updateBatch($actorsFollowersCount, 'id');
        }

        return 0;
    }

    public function clearCache(Actor $actor): void
    {
        $cachePrefix = config('Fediverse')
            ->cachePrefix;
        $hashedActorUri = md5($actor->uri);
        $cacheDomain = str_replace(':', '', $actor->domain);

        cache()
            ->delete($cachePrefix . "actor-{$actor->username}-{$cacheDomain}");
        cache()
            ->delete($cachePrefix . "actor-{$hashedActorUri}");
        cache()
            ->deleteMatching($cachePrefix . "actor#{$actor->id}*");
    }
}
