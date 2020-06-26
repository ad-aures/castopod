<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

/**
 * Return the media base URL to use in views
 *
 * @param  mixed  $uri      URI string or array of URI segments
 * @param  string $protocol
 * @return string
 */
function media_url($uri = '', string $protocol = null): string
{
    return base_url(config('App')->mediaRoot . '/' . $uri, $protocol);
}
