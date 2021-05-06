<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub;

use Exception;

class WebFinger
{
    /**
     * @var string
     */
    const RESOURCE_PATTERN = '/^acct:(?P<username>([\w_]+))@(?P<domain>([\w\-\.]+[\w]+)(:[\d]+)?)$/x';

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $domain;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $port;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var array
     */
    protected $aliases = [];

    /**
     * @var array
     */
    protected $links = [];

    /**
     * @param string $resource
     */
    public function __construct($resource)
    {
        $this->subject = $resource;

        // Split resource into its parts (username, domain)
        $parts = $this->splitResource($resource);
        if (!$parts) {
            throw new Exception('Wrong WebFinger resource pattern.');
        }
        extract($parts);

        $this->username = $username;
        $this->domain = $domain;

        $currentUrl = current_url(true);
        $currentDomain =
            $currentUrl->getHost() .
            ($currentUrl->getPort() ? ':' . $currentUrl->getPort() : '');
        if ($currentDomain !== $domain) {
            // TODO: return error code
            throw new Exception('Domain does not correspond to Instance.');
        }

        if (
            !($actor = model('ActorModel')->getActorByUsername(
                $username,
                $domain,
            ))
        ) {
            throw new Exception('Could not find actor');
        }

        $this->aliases = [$actor->id];
        $this->links = [
            [
                'rel' => 'self',
                'type' => 'application/activity+json',
                'href' => $actor->uri,
            ],
            [
                'rel' => 'http://webfinger.net/rel/profile-page',
                'type' => 'text/html',
                'href' => $actor->uri, # TODO: should there be 2 values? @actorUsername
            ],
        ];
    }

    /**
     * Get WebFinger response as an array
     *
     * @return array<string, array|string>
     */
    public function toArray(): array
    {
        return [
            'subject' => $this->subject,
            'aliases' => $this->aliases,
            'links' => $this->links,
        ];
    }
    /**
     * Split resource into its parts (username, domain)
     *
     * @return bool|mixed
     */
    private function splitResource(string $resource)
    {
        if (!preg_match(self::RESOURCE_PATTERN, $resource, $matches)) {
            // Resource pattern failed
            return false;
        }

        return $matches;
    }
}
