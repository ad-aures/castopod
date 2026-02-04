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

        // Route audio files through MediaController for HTTP Range request support (enables seeking)
        // This is needed because some servers (PHP built-in, nginx Unit) don't support Range requests
        $isAudioFile = preg_match('/\.(mp3|m4a|ogg|wav|flac|aac|opus)$/i', $relativePath);
        if ($isAudioFile) {
            $baseURL = rtrim(config('App')->baseURL, '/');
            return $baseURL . '/media-serve/' . ltrim($relativePath, '/');
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
