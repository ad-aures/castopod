<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Models;

use ActivityPub\Entities\Actor;
use CodeIgniter\Events\Events;
use CodeIgniter\Model;

class ActorModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'activitypub_actors';

    /**
     * @var string[]
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
     * @var string
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
        $cacheName = config('ActivityPub')
            ->cachePrefix . "actor#{$id}";
        if (! ($found = cache($cacheName))) {
            $found = $this->find($id);

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * Looks for actor with username and domain, if no domain has been specified, the current host will be used
     */
    public function getActorByUsername(string $username, ?string $domain = null): ?Actor
    {
        // TODO: is there a better way?
        helper('activitypub');

        if (! $domain) {
            $domain = get_current_domain();
        }

        // remove colons for port if set
        $cacheDomain = str_replace(':', '', $domain);

        $cacheName = "actor-{$username}-{$cacheDomain}";
        if (! ($found = cache($cacheName))) {
            $found = $this->where([
                'username' => $username,
                'domain' => $domain,
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
            config('ActivityPub')
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
            config('ActivityPub')
                ->cachePrefix . "actor#{$actorId}_followers";
        if (! ($found = cache($cacheName))) {
            $found = $this->join('activitypub_follows', 'activitypub_follows.actor_id = id', 'inner')
                ->where('activitypub_follows.target_actor_id', $actorId)
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
        if (($actor = $this->getActorByUri($actorUri)) !== null) {
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
        $cacheName = config('ActivityPub')
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
        $prefix = config('ActivityPub')
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
        $prefix = config('ActivityPub')
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

    public function clearCache(Actor $actor): void
    {
        $cachePrefix = config('ActivityPub')
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
