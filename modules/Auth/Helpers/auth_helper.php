<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use App\Entities\Podcast;
use App\Models\ActorModel;
use App\Models\PodcastModel;
use CodeIgniter\Shield\Entities\User;
use Modules\Auth\Auth;
use Modules\Fediverse\Entities\Actor;
use Modules\Fediverse\Models\NotificationModel;

if (! function_exists('auth')) {
    /**
     * Provides convenient access to the main Auth class for CodeIgniter Shield.
     *
     * @param string|null $alias Authenticator alias
     */
    function auth(?string $alias = null): Auth
    {
        /** @var Auth $auth */
        $auth = service('auth');

        return $auth->setAuthenticator($alias);
    }
}

if (! function_exists('set_interact_as_actor')) {
    /**
     * Sets the actor id of which the user is acting as
     */
    function set_interact_as_actor(int $actorId): void
    {
        if (auth()->loggedIn()) {
            session()
                ->set('interact_as_actor_id', $actorId);
        }
    }
}

if (! function_exists('remove_interact_as_actor')) {
    /**
     * Removes the actor id of which the user is acting as
     */
    function remove_interact_as_actor(): void
    {
        session()->remove('interact_as_actor_id');
    }
}

if (! function_exists('interact_as_actor_id')) {
    /**
     * Sets the podcast id of which the user is acting as
     */
    function interact_as_actor_id(): ?int
    {
        return session()->get('interact_as_actor_id');
    }
}

if (! function_exists('interact_as_actor')) {
    /**
     * Get the actor the user is currently interacting as
     */
    function interact_as_actor(): ?Actor
    {
        if (! auth()->loggedIn()) {
            return null;
        }

        $session = session();
        if (! $session->has('interact_as_actor_id')) {
            return null;
        }

        return model(ActorModel::class, false)->getActorById($session->get('interact_as_actor_id'));
    }
}

if (! function_exists('can_user_interact')) {
    function can_user_interact(): bool
    {
        return (bool) interact_as_actor();
    }
}

if (! function_exists('add_podcast_group')) {
    function add_podcast_group(User $user, int $podcastId, string $group): User
    {
        $podcastGroup = 'podcast#' . $podcastId . '-' . $group;

        return $user->addGroup($podcastGroup);
    }
}

if (! function_exists('get_instance_group')) {
    function get_instance_group(User $user): ?string
    {
        $instanceGroups = array_filter(
            $user->getGroups() ?? [],
            static fn ($group): bool => ! str_starts_with((string) $group, 'podcast#'),
        );

        if ($instanceGroups === []) {
            return null;
        }

        $instanceGroup = array_shift($instanceGroups);

        // Verify that a user belongs to one group only!
        if ($instanceGroups !== []) {
            // remove any other group the user belongs to
            $user->removeGroup(...$instanceGroups);
        }

        return $instanceGroup;
    }
}

if (! function_exists('set_instance_group')) {
    function set_instance_group(User $user, string $group): User
    {
        // remove old instance group
        if (get_instance_group($user)) {
            $user->removeGroup(get_instance_group($user));
        }

        // set new group
        return $user->addGroup($group);
    }
}

if (! function_exists('get_podcast_group')) {
    function get_podcast_group(User $user, int $podcastId, bool $removePrefix = true): ?string
    {
        $podcastGroups = array_filter(
            $user->getGroups() ?? [],
            static fn ($group): bool => str_starts_with((string) $group, "podcast#{$podcastId}-"),
        );

        if ($podcastGroups === []) {
            return null;
        }

        $podcastGroup = array_shift($podcastGroups);

        // Verify that a user belongs to one group only!
        if ($podcastGroups !== []) {
            // remove any other group the user belongs to
            $user->removeGroup(...$podcastGroups);
        }

        if ($removePrefix) {
            // strip the `podcast#{id}-` prefix when returning group
            return substr((string) $podcastGroup, strlen('podcast#' . $podcastId . '-'));
        }

        return $podcastGroup;
    }
}

if (! function_exists('set_podcast_group')) {
    function set_podcast_group(User $user, int $podcastId, string $group): User
    {
        // remove old instance group
        $user->removeGroup("podcast#{$podcastId}-" . get_podcast_group($user, $podcastId));

        // set new group
        return add_podcast_group($user, $podcastId, $group);
    }
}

if (! function_exists('get_podcast_groups')) {
    /**
     * @return string[]
     */
    function get_user_podcast_ids(User $user): array
    {
        $podcastGroups = array_filter(
            $user->getGroups() ?? [],
            static fn ($group): bool => str_starts_with((string) $group, 'podcast#'),
        );

        $userPodcastIds = [];
        // extract all podcast ids from groups
        foreach ($podcastGroups as $podcastGroup) {
            // extract podcast id from group and add it to the list of ids
            preg_match('~podcast#(\d+)-[a-z]+~', (string) $podcastGroup, $matches);
            $userPodcastIds[] = $matches[1];
        }

        return $userPodcastIds;
    }
}

if (! function_exists('can_podcast')) {
    function can_podcast(User $user, int $podcastId, string $permission): bool
    {
        return $user->can('podcast#' . $podcastId . '.' . $permission);
    }
}

if (! function_exists('get_user_podcasts')) {
    /**
     * Returns the podcasts the user is contributing to
     *
     * @return Podcast[]
     */
    function get_user_podcasts(User $user): array
    {
        return new PodcastModel()
            ->getUserPodcasts($user->id, get_user_podcast_ids($user));
    }
}

if (! function_exists('get_podcasts_user_can_interact_with')) {
    /**
     * @return Podcast[]
     */
    function get_podcasts_user_can_interact_with(User $user): array
    {
        $userPodcasts = new PodcastModel()
            ->getUserPodcasts($user->id, get_user_podcast_ids($user));

        $hasInteractAsPrivilege = interact_as_actor_id() === null;

        if ($userPodcasts === []) {
            if ($hasInteractAsPrivilege) {
                remove_interact_as_actor();
            }

            return [];
        }

        $isInteractAsPrivilegeLost = true;
        $podcastsUserCanInteractWith = [];
        foreach ($userPodcasts as $userPodcast) {
            if (can_podcast($user, $userPodcast->id, 'interact-as')) {
                if (interact_as_actor_id() === $userPodcast->actor_id) {
                    $isInteractAsPrivilegeLost = false;
                }

                $podcastsUserCanInteractWith[] = $userPodcast;
            }
        }

        if ($podcastsUserCanInteractWith === []) {
            if (interact_as_actor_id() !== null) {
                remove_interact_as_actor();
            }

            return [];
        }

        // check if user has lost the interact as privilege for current podcast actor.
        // --> Remove interact as if there's no podcast actor to interact as
        // or set the first podcast actor the user can interact as
        if ($isInteractAsPrivilegeLost) {
            set_interact_as_actor($podcastsUserCanInteractWith[0]->actor_id);
        }

        return $podcastsUserCanInteractWith;
    }
}

if (! function_exists('get_actor_ids_with_unread_notifications')) {
    /**
     * Returns the ids of the user's actors that have unread notifications
     *
     * @return int[]
     */
    function get_actor_ids_with_unread_notifications(User $user): array
    {
        if (($userPodcasts = get_user_podcasts($user)) === []) {
            return [];
        }

        $unreadNotifications = new NotificationModel()
            ->whereIn('target_actor_id', array_column($userPodcasts, 'actor_id'))
            ->where('read_at')
            ->findAll();

        return array_column($unreadNotifications, 'target_actor_id');
    }
}

if (! function_exists('get_group_title')) {
    /**
     * @return array<'title'|'description', string>
     */
    function get_group_info(string $group, ?int $podcastId = null): array
    {
        if ($podcastId === null) {
            return setting('AuthGroups.instanceGroups')[$group];
        }

        return setting('AuthGroups.podcastGroups')[$group];
    }
}
