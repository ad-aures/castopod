<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

if (!function_exists('host_url')) {
    /**
     * Return the host URL to use in views
     *
     * @return string|false
     */
    function host_url()
    {
        if (isset($_SERVER['HTTP_HOST'])) {
            $protocol =
                (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
                $_SERVER['SERVER_PORT'] == 443
                    ? 'https://'
                    : 'http://';
            return $protocol . $_SERVER['HTTP_HOST'] . '/';
        }

        return false;
    }
}

if (!function_exists('current_season_url')) {
    /**
     * Return the podcast URL with season number to use in views
     */
    function current_season_url(): string
    {
        $season_query_string = '';
        if (isset($_GET['season'])) {
            $season_query_string = '?season=' . $_GET['season'];
        } elseif (isset($_GET['year'])) {
            $season_query_string = '?year=' . $_GET['year'];
        }
        return current_url() . $season_query_string;
    }
}

if (!function_exists('location_url')) {
    /**
     * Returns URL to display from location info
     */
    function location_url(
        string $locationName,
        ?string $locationGeo = null,
        ?string $locationOsmid = null
    ): string {
        if (!empty($locationOsmid)) {
            return 'https://www.openstreetmap.org/' .
                ['N' => 'node', 'W' => 'way', 'R' => 'relation'][
                    substr($locationOsmid, 0, 1)
                ] .
                '/' .
                substr($locationOsmid, 1);
        }
        if (!empty($locationGeo)) {
            return 'https://www.openstreetmap.org/#map=17/' .
                str_replace(',', '/', substr($locationGeo, 4));
        }

        return 'https://www.openstreetmap.org/search?query=' .
            urlencode($locationName);
    }
}
//--------------------------------------------------------------------

if (!function_exists('extract_params_from_episode_uri')) {
    /**
     * Returns podcast name and episode slug from episode string uri
     *
     * @param URI $episodeUri
     */
    function extract_params_from_episode_uri($episodeUri): ?array
    {
        preg_match(
            '~@(?P<podcastName>[a-zA-Z0-9\_]{1,32})\/episodes\/(?P<episodeSlug>[a-zA-Z0-9\-]{1,191})~',
            $episodeUri->getPath(),
            $matches,
        );

        if ($matches === []) {
            return null;
        }

        if (
            !array_key_exists('podcastName', $matches) ||
            !array_key_exists('episodeSlug', $matches)
        ) {
            return null;
        }

        return [
            'podcastName' => $matches['podcastName'],
            'episodeSlug' => $matches['episodeSlug'],
        ];
    }
}
