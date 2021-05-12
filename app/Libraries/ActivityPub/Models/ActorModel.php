<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Models;

use ActivityPub\Entities\Actor;
use CodeIgniter\Database\Exceptions\DataException;
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
        'notes_count',
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

    public function getActorById($id): Actor
    {
        $cacheName = config('ActivityPub')->cachePrefix . "actor#{$id}";
        if (!($found = cache($cacheName))) {
            $found = $this->find($id);

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * Looks for actor with username and domain,
     * if no domain has been specified, the current host will be used
     */
    public function getActorByUsername(
        string $username,
        ?string $domain = null
    ): ?Actor {
        // TODO: is there a better way?
        helper('activitypub');

        if (!$domain) {
            $domain = get_current_domain();
        }

        $cacheName = "actor-{$username}-{$domain}";
        if (!($found = cache($cacheName))) {
            $found = $this->where([
                'username' => $username,
                'domain' => $domain,
            ])->first();

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getActorByUri($actorUri)
    {
        $hashedActorUri = md5($actorUri);
        $cacheName =
            config('ActivityPub')->cachePrefix . "actor-{$hashedActorUri}";
        if (!($found = cache($cacheName))) {
            $found = $this->where('uri', $actorUri)->first();

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getFollowers($actorId)
    {
        $cacheName =
            config('ActivityPub')->cachePrefix . "actor#{$actorId}_followers";
        if (!($found = cache($cacheName))) {
            $found = $this->join(
                'activitypub_follows',
                'activitypub_follows.actor_id = id',
                'inner',
            )
                ->where('activitypub_follows.target_actor_id', $actorId)
                ->findAll();

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * Check if an existing actor is blocked using its uri.
     * Returns FALSE if the actor doesn't exist
     */
    public function isActorBlocked(string $actorUri): bool
    {
        if ($actor = $this->getActorByUri($actorUri)) {
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
        $cacheName = config('ActivityPub')->cachePrefix . 'blocked_actors';
        if (!($found = cache($cacheName))) {
            $found = $this->where('is_blocked', 1)->findAll();

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function blockActor($actorId): void
    {
        $prefix = config('ActivityPub')->cachePrefix;
        cache()->delete($prefix . 'blocked_actors');
        cache()->deleteMatching($prefix . '*replies');

        Events::trigger('on_block_actor', $actorId);

        $this->update($actorId, ['is_blocked' => 1]);
    }

    public function unblockActor($actorId): void
    {
        $prefix = config('ActivityPub')->cachePrefix;
        cache()->delete($prefix . 'blocked_actors');
        cache()->deleteMatching($prefix . '*replies');

        Events::trigger('on_unblock_actor', $actorId);

        $this->update($actorId, ['is_blocked' => 0]);
    }
}
