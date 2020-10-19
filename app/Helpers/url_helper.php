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
