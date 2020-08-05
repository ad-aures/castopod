<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use Config\Services;

/**
 * Returns the inline svg icon
 *
 * @param  string $name name of the icon file without the .svg extension
 * @param  string $class to be added to the svg string
 * @return string html breadcrumb
 */
function render_breadcrumb()
{
    $breadcrumb = Services::breadcrumb();
    return $breadcrumb->render();
}

function replace_breadcrumb_params($newParams)
{
    $breadcrumb = Services::breadcrumb();
    $breadcrumb->replaceParams($newParams);
}
