<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Auth\Models;

use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel
{
    /**
     * @var list<string>
     */
    protected $allowedFields = [
        'username',
        'status',
        'status_message',
        'active',
        'is_owner',
        'last_active',
        'deleted_at',
    ];

    /**
     * @return User[]
     */
    public function getPodcastContributors(int $podcastId): array
    {
        return $this->select('users.*')
            ->join('auth_groups_users', 'users.id = auth_groups_users.user_id')
            ->like('auth_groups_users.group', "podcast#{$podcastId}-")
            ->findAll();
    }

    public function getPodcastContributor(int $contributorId, int $podcastId): ?User
    {
        return $this->select('users.*')
            ->join('auth_groups_users', 'users.id = auth_groups_users.user_id')
            ->where('users.id', $contributorId)
            ->like('auth_groups_users.group', "podcast#{$podcastId}-")
            ->first();
    }
}
