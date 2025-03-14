<?php

declare(strict_types=1);

use App\Entities\Person;
use App\Entities\Podcast;
use Cocur\Slugify\Slugify;
use Config\Images;
use Modules\Media\Entities\Image;

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

if (! function_exists('get_browser_language')) {
    /**
     * Gets the browser default language using the request header key `HTTP_ACCEPT_LANGUAGE`. Returns Castopod's default
     * locale if `HTTP_ACCEPT_LANGUAGE` is null.
     *
     * @return string ISO 639-1 language code
     */
    function get_browser_language(?string $httpAcceptLanguage = null): string
    {
        if ($httpAcceptLanguage === null) {
            return config('App')->defaultLocale;
        }

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

        $slugify = new Slugify();
        return $slugify->slugify($text);
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

if (! function_exists('generate_random_salt')) {
    function generate_random_salt(int $length = 64): string
    {
        $salt = '';
        while (strlen($salt) < $length) {
            $charNumber = random_int(33, 126);
            // Exclude " ' \ `
            if (! in_array($charNumber, [34, 39, 92, 96], true)) {
                $salt .= chr($charNumber);
            }
        }

        return $salt;
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
            return round($size * 1024 ** ((float) stripos('bkmgtpezy', $unit[0])));
        }

        return round($size);
    }
}

if (! function_exists('format_bytes')) {
    /**
     * Adapted from https://stackoverflow.com/a/2510459
     */
    function formatBytes(float $bytes, bool $is_binary = false, int $precision = 2): string
    {
        $units = $is_binary ? ['B', 'KiB', 'MiB', 'GiB', 'TiB'] : ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log($is_binary ? 1024 : 1000));
        $pow = min($pow, count($units) - 1);

        $bytes /= ($is_binary ? 1024 : 1000) ** $pow;

        return round($bytes, $precision) . $units[$pow];
    }
}

if (! function_exists('get_site_icon_url')) {
    function get_site_icon_url(string $size): string
    {
        if (config('App')->siteIcon['ico'] === service('settings')->get('App.siteIcon')['ico']) {
            // return default site icon url
            return base_url(service('settings')->get('App.siteIcon')[$size]);
        }

        return service('file_manager')->getUrl(service('settings')->get('App.siteIcon')[$size]);
    }
}

if (! function_exists('get_podcast_banner')) {
    function get_podcast_banner_url(Podcast $podcast, string $size): string
    {
        if (! $podcast->banner instanceof Image) {
            $defaultBanner = config('Images')
                ->podcastBannerDefaultPaths[service('settings')->get('App.theme')] ?? config(
                    Images::class,
                )->podcastBannerDefaultPaths['default'];

            $sizes = config('Images')
                ->podcastBannerSizes;

            $sizeConfig = $sizes[$size];
            helper('filesystem');

            // return default site icon url
            return base_url(
                change_file_path($defaultBanner['path'], '_' . $size, $sizeConfig['extension'] ?? null),
            );
        }

        $sizeKey = $size . '_url';
        return $podcast->banner->{$sizeKey};
    }
}

if (! function_exists('get_podcast_banner_mimetype')) {
    function get_podcast_banner_mimetype(Podcast $podcast, string $size): string
    {
        if (! $podcast->banner instanceof Image) {
            $sizes = config('Images')
                ->podcastBannerSizes;

            $sizeConfig = $sizes[$size];
            helper('filesystem');

            // return default site icon url
            return array_key_exists('mimetype', $sizeConfig) ? $sizeConfig['mimetype'] : config(
                Images::class,
            )->podcastBannerDefaultMimeType;
        }

        $mimetype = $size . '_mimetype';
        return $podcast->banner->{$mimetype};
    }
}

if (! function_exists('get_avatar_url')) {
    function get_avatar_url(Person $person, string $size): string
    {
        if (! $person->avatar instanceof Image) {
            $defaultAvatarPath = config('Images')
                ->avatarDefaultPath;

            $sizes = config('Images')
                ->personAvatarSizes;

            $sizeConfig = $sizes[$size];

            helper('filesystem');

            // return default avatar url
            return base_url(change_file_path($defaultAvatarPath, '_' . $size, $sizeConfig['extension'] ?? null));
        }

        $sizeKey = $size . '_url';
        return $person->avatar->{$sizeKey};
    }
}
