<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Models;

use CodeIgniter\Events\Events;
use CodeIgniter\Model;

class BlockedDomainModel extends Model
{
    protected $table = 'activitypub_blocked_domains';
    protected $primaryKey = 'name';

    protected $allowedFields = ['name'];

    protected $returnType = \ActivityPub\Entities\BlockedDomain::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;
    protected $updatedField = null;

    /**
     * Retrieves instance or podcast domain blocks depending on whether or not $podcastId param is set.
     *
     * @param integer|null $podcastId
     */
    public function getBlockedDomains()
    {
        $cacheName = config('ActivityPub')->cachePrefix . 'blocked_domains';
        if (!($found = cache($cacheName))) {
            $found = $this->findAll();

            cache()->save($cacheName, $found, DECADE);
        }
        return $found;
    }

    public function isDomainBlocked($domain)
    {
        $hashedDomain = md5($domain);
        $cacheName =
            config('ActivityPub')->cachePrefix .
            "domain#{$hashedDomain}_isBlocked";
        if (!($found = cache($cacheName))) {
            $found = $this->find($domain) ? true : false;

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function blockDomain($name)
    {
        $hashedDomain = md5($name);
        $prefix = config('ActivityPub')->cachePrefix;
        cache()->delete($prefix . "domain#{$hashedDomain}_isBlocked");
        cache()->delete($prefix . 'blocked_domains');

        cache()->deleteMatching($prefix . '*replies');

        Events::trigger('on_block_domain', $name);

        $this->db->transStart();

        // set all actors from the domain as blocked
        model('ActorModel')
            ->where('domain', $name)
            ->set('is_blocked', 1)
            ->update();

        $result = $this->insert([
            'name' => $name,
        ]);

        $this->db->transComplete();

        return $result;
    }

    public function unblockDomain($name)
    {
        $hashedDomain = md5($name);
        $prefix = config('ActivityPub')->cachePrefix;
        cache()->delete($prefix . "domain#{$hashedDomain}_isBlocked");
        cache()->delete($prefix . 'blocked_domains');

        cache()->deleteMatching($prefix . '*replies');

        Events::trigger('on_unblock_domain', $name);

        $this->db->transStart();
        // unblock all actors from the domain
        model('ActorModel')
            ->where('domain', $name)
            ->set('is_blocked', 0)
            ->update();

        $result = $this->delete($name);

        $this->db->transComplete();

        return $result;
    }
}
