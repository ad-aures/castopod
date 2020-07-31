<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

/**
 * Gets the browser default language using the request header key `HTTP_ACCEPT_LANGUAGE`
 *
 * @param mixed $http_accept_language
 *
 * @return string|null ISO 639-1 language code or null
 */
function get_browser_language($http_accept_language)
{
    $langs = explode(',', $http_accept_language);
    if (!empty($langs)) {
        return substr($langs[0], 0, 2);
    }

    return null;
}

/**
 * Check if a string starts with some characters
 *
 * @param string $string
 * @param string $query
 *
 * @return bool
 */
function startsWith($string, $query)
{
    return substr($string, 0, strlen($query)) === $query;
}
