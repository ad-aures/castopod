<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Models;

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
        return $this->findAll();
    }

    public function isDomainBlocked($domain)
    {
        if ($this->find($domain)) {
            return true;
        }

        return false;
    }

    public function blockDomain($name)
    {
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
