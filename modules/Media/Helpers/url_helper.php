<?php

declare(strict_types=1);

use CodeIgniter\HTTP\URI;

if (! function_exists('media_url')) {
    /**
     * Returns a media URL as defined by the Media config.
     *
     * @param array<string>|string $relativePath URI string or array of URI segments
     */
    function media_url(array|string $relativePath = '', ?string $scheme = null): string
    {
        // Convert array of segments to a string
        if (is_array($relativePath)) {
            $relativePath = implode('/', $relativePath);
        }

        $uri = new URI(rtrim(config('Media')->baseURL, '/') . '/' . ltrim($relativePath));

        return URI::createURIString(
            $scheme ?? $uri->getScheme(),
            $uri->getAuthority(),
            $uri->getPath(),
            $uri->getQuery(),
            $uri->getFragment(),
        );
    }
}
