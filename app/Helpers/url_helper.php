<?php

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
     *
     * @return string
     */
    function current_season_url()
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
