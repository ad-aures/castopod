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

function slugify($text)
{
    if (empty($text)) {
        return 'n-a';
    }

    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    $unwanted_array = [
        'Š' => 'S',
        'š' => 's',
        'Đ' => 'Dj',
        'đ' => 'dj',
        'Ž' => 'Z',
        'ž' => 'z',
        'Č' => 'C',
        'č' => 'c',
        'Ć' => 'C',
        'ć' => 'c',
        'À' => 'A',
        'Á' => 'A',
        'Â' => 'A',
        'Ã' => 'A',
        'Ä' => 'A',
        'Å' => 'A',
        'Æ' => 'AE',
        'Ç' => 'C',
        'È' => 'E',
        'É' => 'E',
        'Ê' => 'E',
        'Ë' => 'E',
        'Ì' => 'I',
        'Í' => 'I',
        'Î' => 'I',
        'Ï' => 'I',
        'Ñ' => 'N',
        'Ò' => 'O',
        'Ó' => 'O',
        'Ô' => 'O',
        'Õ' => 'O',
        'Ö' => 'O',
        'Ø' => 'O',
        'Œ' => 'OE',
        'Ù' => 'U',
        'Ú' => 'U',
        'Û' => 'U',
        'Ü' => 'U',
        'Ý' => 'Y',
        'Þ' => 'B',
        'ß' => 'Ss',
        'à' => 'a',
        'á' => 'a',
        'â' => 'a',
        'ã' => 'a',
        'ä' => 'a',
        'å' => 'a',
        'æ' => 'ae',
        'ç' => 'c',
        'è' => 'e',
        'é' => 'e',
        'ê' => 'e',
        'ë' => 'e',
        'ì' => 'i',
        'í' => 'i',
        'î' => 'i',
        'ï' => 'i',
        'ð' => 'o',
        'ñ' => 'n',
        'ò' => 'o',
        'ó' => 'o',
        'ô' => 'o',
        'õ' => 'o',
        'ö' => 'o',
        'ø' => 'o',
        'œ' => 'OE',
        'ù' => 'u',
        'ú' => 'u',
        'û' => 'u',
        'ý' => 'y',
        'ý' => 'y',
        'þ' => 'b',
        'ÿ' => 'y',
        'Ŕ' => 'R',
        'ŕ' => 'r',
        '/' => '-',
        ' ' => '-',
    ];
    $text = strtr($text, $unwanted_array);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    return $text;
}

//--------------------------------------------------------------------

if (!function_exists('format_duration')) {
    /**
     * Formats duration in seconds to an hh:mm:ss string
     *
     * @param int $seconds seconds to format
     * @param string $separator
     *
     * @return string
     */
    function format_duration($seconds, $separator = ':')
    {
        return sprintf(
            '%02d%s%02d%s%02d',
            floor($seconds / 3600),
            $separator,
            ($seconds / 60) % 60,
            $separator,
            $seconds % 60
        );
    }
}

//--------------------------------------------------------------------
