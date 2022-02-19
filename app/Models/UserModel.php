<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use Modules\Auth\Entities\User;
use Myth\Auth\Models\UserModel as MythAuthUserModel;

class UserModel extends MythAuthUserModel
{
    /**
     * @var string
     */
    protected $returnType = User::class;

    /**
     * @return User[]
     */
    public function getPodcastContributors(int $podcastId): array
    {
        $cacheName = "podcast#{$podcastId}_contributors";
        if (! ($found = cache($cacheName))) {
            $found = $this->select('users.*, auth_groups.name as podcast_role')
                ->join('podcasts_users', 'podcasts_users.user_id = users.id')
                ->join('auth_groups', 'auth_groups.id = podcasts_users.group_id')
                ->where('podcasts_users.podcast_id', $podcastId)
                ->findAll();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getPodcastContributor(int $userId, int $podcastId): ?User
    {
        return $this->select('users.*, podcasts_users.podcast_id as podcast_id, auth_groups.name as podcast_role')
            ->join('podcasts_users', 'podcasts_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = podcasts_users.group_id')
            ->where([
                'users.id' => $userId,
                'podcast_id' => $podcastId,
            ])
            ->first();
    }
}
