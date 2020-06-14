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

/**
 * Return the podcast URL to use in views
 *
 * @param  mixed  $uri      URI string or array of URI segments
 * @param  string $protocol
 * @return string
 */
function podcast_url(
    $podcast_id = 1,
    $episode_id = 1,
    $podcast_name = '',
    $uri = '',
    string $protocol = null
): string {
    return base_url(
        "/stats/$podcast_id/$episode_id/$podcast_name/$uri",
        $protocol
    );
}
