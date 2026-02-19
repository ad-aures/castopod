<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Models;

use CodeIgniter\Database\BaseResult;
use CodeIgniter\Events\Events;
use CodeIgniter\Model;
use Modules\Fediverse\Entities\BlockedDomain;

class BlockedDomainModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'fediverse_blocked_domains';

    /**
     * @var string
     */
    protected $primaryKey = 'name';

    /**
     * @var list<string>
     */
    protected $allowedFields = ['name'];

    /**
     * @var class-string<BlockedDomain>
     */
    protected $returnType = BlockedDomain::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    protected $updatedField = '';

    /**
     * Retrieves instance or podcast domain blocks depending on whether or not $podcastId param is set.
     *
     * @return BlockedDomain[]
     */
    public function getBlockedDomains(): array
    {
        $cacheName = config('Fediverse')
            ->cachePrefix . 'blocked_domains';
        if (! ($found = cache($cacheName))) {
            $found = $this->findAll();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function isDomainBlocked(string $name): bool
    {
        $hashedDomainName = md5($name);
        $cacheName =
            config('Fediverse')
                ->cachePrefix .
            "domain#{$hashedDomainName}_isBlocked";
        if (! ($found = cache($cacheName))) {
            $found = (bool) $this->find($name);

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function blockDomain(string $name): int | bool
    {
        $hashedDomain = md5($name);
        $prefix = config('Fediverse')
            ->cachePrefix;
        cache()
            ->delete($prefix . "domain#{$hashedDomain}_isBlocked");
        cache()
            ->delete($prefix . 'blocked_domains');

        cache()
            ->deleteMatching($prefix . '*replies');

        $this->db->transStart();

        // set all actors from the domain as blocked
        model('ActorModel', false)
            ->where('domain', $name)
            ->set('is_blocked', '1')
            ->update();

        $result = $this->insert([
            'name' => $name,
        ]);

        Events::trigger('on_block_domain', $name);

        $this->db->transComplete();

        return $result;
    }

    public function unblockDomain(string $name): BaseResult | bool
    {
        $hashedDomain = md5($name);
        $prefix = config('Fediverse')
            ->cachePrefix;
        cache()
            ->delete($prefix . "domain#{$hashedDomain}_isBlocked");
        cache()
            ->delete($prefix . 'blocked_domains');

        cache()
            ->deleteMatching($prefix . '*replies');

        $this->db->transStart();
        // unblock all actors from the domain
        model('ActorModel', false)
            ->where('domain', $name)
            ->set('is_blocked', '0')
            ->update();

        $result = $this->delete($name);

        Events::trigger('on_unblock_domain', $name);

        $this->db->transComplete();

        return $result;
    }
}
