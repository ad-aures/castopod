<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use CodeIgniter\HTTP\URI;

if (! function_exists('host_url')) {
    /**
     * Return the host URL to use in views
     */
    function host_url(): ?string
    {
        $superglobals = service('superglobals');
        if ($superglobals->server('HTTP_HOST') !== null) {
            $protocol =
                ($superglobals->server('HTTPS') !== null && $superglobals->server('HTTPS') !== 'off') ||
                (int) $superglobals->server('SERVER_PORT') === 443
                    ? 'https://'
                    : 'http://';
            return $protocol . $superglobals->server('HTTP_HOST') . '/';
        }

        return null;
    }
}

//--------------------------------------------------------------------

/**
 * Return the host URL to use in views
 */
if (! function_exists('current_domain')) {
    /**
     * Returns instance's domain name
     */
    function current_domain(): string
    {
        /** @var URI $uri */
        $uri = current_url(true);

        return $uri->getHost() . ($uri->getPort() ? ':' . $uri->getPort() : '');
    }
}

//--------------------------------------------------------------------

if (! function_exists('extract_params_from_episode_uri')) {
    /**
     * Returns podcast name and episode slug from episode string
     *
     * @return array<string, string>|null
     */
    function extract_params_from_episode_uri(URI $episodeUri): ?array
    {
        preg_match(
            '~@(?P<podcastHandle>[a-zA-Z0-9\_]{1,32})\/episodes\/(?P<episodeSlug>[a-zA-Z0-9\-]{1,128})~',
            $episodeUri->getPath(),
            $matches,
        );

        if ($matches === []) {
            return null;
        }

        if (
            ! array_key_exists('podcastHandle', $matches) ||
            ! array_key_exists('episodeSlug', $matches)
        ) {
            return null;
        }

        return [
            'podcastHandle' => $matches['podcastHandle'],
            'episodeSlug'   => $matches['episodeSlug'],
        ];
    }
}
