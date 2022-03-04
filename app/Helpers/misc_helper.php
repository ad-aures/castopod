<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

if (! function_exists('get_browser_language')) {
    /**
     * Gets the browser default language using the request header key `HTTP_ACCEPT_LANGUAGE`
     *
     * @return string ISO 639-1 language code
     */
    function get_browser_language(string $httpAcceptLanguage): string
    {
        $langs = explode(',', $httpAcceptLanguage);

        return substr($langs[0], 0, 2);
    }
}

if (! function_exists('slugify')) {
    function slugify(string $text, int $maxLength = 128): string
    {
        // trim text to the nearest whole word if too long
        if (strlen($text) > $maxLength) {
            $text = substr($text, 0, strrpos(substr($text, 0, $maxLength), ' '));
        }

        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        $unwanted = [
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
            'þ' => 'b',
            'ÿ' => 'y',
            'Ŕ' => 'R',
            'ŕ' => 'r',
            '/' => '-',
            ' ' => '-',
        ];
        $text = strtr($text, $unwanted);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^\-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        return $text;
    }
}

//--------------------------------------------------------------------

if (! function_exists('format_duration')) {
    /**
     * Formats duration in seconds to an hh:mm:ss string.
     *
     * ⚠️ This uses php's gmdate function so any duration > 86000 seconds (24 hours) will not be formatted properly.
     *
     * @param int $seconds seconds to format
     */
    function format_duration(int $seconds, bool $showLeadingZeros = false): string
    {
        if ($showLeadingZeros) {
            return gmdate('H:i:s', $seconds);
        }

        if ($seconds < 60) {
            return '0:' . sprintf('%02d', $seconds);
        }

        if ($seconds < 3600) {
            // < 1 hour: returns MM:SS
            return ltrim(gmdate('i:s', $seconds), '0');
        }

        if ($seconds < 36000) {
            // < 10 hours: returns H:MM:SS
            return ltrim(gmdate('H:i:s', $seconds), '0');
        }

        return gmdate('H:i:s', $seconds);
    }
}


if (! function_exists('format_duration_symbol')) {
    /**
     * Formats duration in seconds to an hh(h) mm(min) ss(s) string. Doesn't show leading zeros if any.
     *
     * ⚠️ This uses php's gmdate function so any duration > 86000 seconds (24 hours) will not be formatted properly.
     *
     * @param int $seconds seconds to format
     */
    function format_duration_symbol(int $seconds): string
    {
        if ($seconds < 60) {
            return $seconds . 's';
        }

        if ($seconds < 3600) {
            // < 1 hour: returns MM:SS
            return ltrim(gmdate('i\m\i\n s\s', $seconds), '0');
        }

        if ($seconds < 36000) {
            // < 10 hours: returns H:MM:SS
            return ltrim(gmdate('h\h i\m\i\n s\s', $seconds), '0');
        }

        return gmdate('h\h i\m\i\n s\s', $seconds);
    }
}

//--------------------------------------------------------------------

if (! function_exists('podcast_uuid')) {
    /**
     * Generate UUIDv5 for podcast. For more information, see
     * https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md#guid
     */
    function podcast_uuid(string $feedUrl): string
    {
        $uuid = service('uuid');
        // 'ead4c236-bf58-58c6-a2c6-a6b28d128cb6' is the uuid of the podcast namespace
        return $uuid->uuid5('ead4c236-bf58-58c6-a2c6-a6b28d128cb6', $feedUrl)
            ->toString();
    }
}

//--------------------------------------------------------------------


if (! function_exists('file_upload_max_size')) {

    /**
     * Returns a file size limit in bytes based on the PHP upload_max_filesize and post_max_size Adapted from:
     * https://stackoverflow.com/a/25370978
     */
    function file_upload_max_size(): float
    {
        static $max_size = -1;

        if ($max_size < 0) {
            // Start with post_max_size.
            $post_max_size = parse_size((string) ini_get('post_max_size'));
            if ($post_max_size > 0) {
                $max_size = $post_max_size;
            }

            // If upload_max_size is less, then reduce. Except if upload_max_size is
            // zero, which indicates no limit.
            $upload_max = parse_size((string) ini_get('upload_max_filesize'));
            if ($upload_max > 0 && $upload_max < $max_size) {
                $max_size = $upload_max;
            }
        }

        return $max_size;
    }
}

if (! function_exists('parse_size')) {
    function parse_size(string $size): float
    {
        $unit = (string) preg_replace('~[^bkmgtpezy]~i', '', $size); // Remove the non-unit characters from the size.
        $size = (float) preg_replace('~[^0-9\.]~', '', $size); // Remove the non-numeric characters from the size.
        if ($unit !== '') {
            // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
            return round($size * pow(1024, (float) stripos('bkmgtpezy', $unit[0])));
        }

        return round($size);
    }
}

if (! function_exists('format_bytes')) {
    /**
     * Adapted from https://stackoverflow.com/a/2510459
     */
    function formatBytes(float $bytes, int $precision = 2): string
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . $units[$pow];
    }
}
