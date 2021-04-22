<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use CodeIgniter\Database\Exceptions\DataException;
use Config\Services;

if (!function_exists('set_interact_as_actor')) {
    /**
     * Sets the actor id of which the user is acting as
     *
     * @return void
     */
    function set_interact_as_actor($actorId)
    {
        $authenticate = Services::authentication();
        $authenticate->check();

        $session = session();
        $session->set('interact_as_actor_id', $actorId);
    }
}

if (!function_exists('remove_interact_as_actor')) {
    /**
     * Removes the actor id of which the user is acting as
     *
     * @return void
     */
    function remove_interact_as_actor()
    {
        $session = session();
        $session->remove('interact_as_actor_id');
    }
}

if (!function_exists('interact_as_actor_id')) {
    /**
     * Sets the podcast id of which the user is acting as
     *
     * @return integer
     */
    function interact_as_actor_id()
    {
        $authenticate = Services::authentication();
        $authenticate->check();

        $session = session();
        return $session->get('interact_as_actor_id');
    }
}

if (!function_exists('interact_as_actor')) {
    /**
     * Get the actor the user is currently interacting as
     *
     * @return \ActivityPub\Entities\Actor|false
     */
    function interact_as_actor()
    {
        $authenticate = Services::authentication();
        $authenticate->check();

        $session = session();
        if ($session->has('interact_as_actor_id')) {
            return model('ActorModel')->getActorById(
                $session->get('interact_as_actor_id'),
            );
        }

        return false;
    }
}

if (!function_exists('can_user_interact')) {
    /**
     * @return bool
     * @throws DataException
     */
    function can_user_interact()
    {
        return interact_as_actor() ? true : false;
    }
}
