<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use Config\Services;

/**
 * Renders the breadcrumb navigation through the Breadcrumb service
 *
 * @param  string $class to be added to the breadcrumb nav
 * @return string html breadcrumb
 */
function render_breadcrumb($class = null)
{
    $breadcrumb = Services::breadcrumb();
    return $breadcrumb->render($class);
}

function replace_breadcrumb_params($newParams)
{
    $breadcrumb = Services::breadcrumb();
    $breadcrumb->replaceParams($newParams);
}
