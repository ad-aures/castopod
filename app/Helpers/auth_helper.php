<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

/**
 * Gets the permission name by concatenating the context and action
 *
 * @param string $context
 * @param string $action
 *
 * @return string permission name
 */
function get_permission($context, $action)
{
    return $context . '-' . $action;
}
