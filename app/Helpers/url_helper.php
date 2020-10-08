<?php

if (!function_exists('host_url')) {
    /**
     * Return the host URL to use in views
     *
     * @return string|false
     */
    function host_url()
    {
        if (isset($_SERVER['host'])) {
            $protocol =
                (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
                $_SERVER['SERVER_PORT'] == 443
                    ? 'https://'
                    : 'http://';
            return $protocol + $_SERVER['host'];
        }

        return false;
    }
}
