<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Auth\Entities;

use App\Entities\Podcast;
use App\Models\NotificationModel;
use App\Models\PodcastModel;
use Myth\Auth\Entities\User as MythAuthUser;
use RuntimeException;

/**
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property bool $active
 * @property bool $force_pass_reset
 * @property int|null $podcast_id
 * @property string|null $podcast_role
 *
 * @property Podcast[] $podcasts All podcasts the user is contributing to
 * @property int[] $actorIdsWithUnreadNotifications Ids of the user's actors that have unread notifications
 */
class User extends MythAuthUser
{
    /**
     * @var Podcast[]|null
     */
    protected ?array $podcasts = null;

    /**
     * @var int[]|null
     */
    protected ?array $actorIdsWithUnreadNotifications = null;

    /**
     * Array of field names and the type of value to cast them as when they are accessed.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'active' => 'boolean',
        'force_pass_reset' => 'boolean',
        'podcast_id' => '?integer',
        'podcast_role' => '?string',
    ];

    /**
     * Returns the podcasts the user is contributing to
     *
     * @return Podcast[]
     */
    public function getPodcasts(): array
    {
        if ($this->id === null) {
            throw new RuntimeException('Users must be created before getting podcasts.');
        }

        if ($this->podcasts === null) {
            $this->podcasts = (new PodcastModel())->getUserPodcasts($this->id);
        }

        return $this->podcasts;
    }

    /**
     * Returns the ids of the user's actors that have unread notifications
     *
     * @return int[]
     */
    public function getActorIdsWithUnreadNotifications(): array
    {
        if ($this->getPodcasts() === []) {
            return [];
        }

        $unreadNotifications = (new NotificationModel())->whereIn(
            'target_actor_id',
            array_column($this->getPodcasts(), 'actor_id')
        )
            ->where('read_at', null)
            ->findAll();

        return array_column($unreadNotifications, 'target_actor_id');
    }
}
