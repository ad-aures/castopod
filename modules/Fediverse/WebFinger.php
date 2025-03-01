<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse;

use Exception;
use Modules\Fediverse\Entities\Actor;

class WebFinger
{
    private const string RESOURCE_PATTERN = '/^acct:(?P<username>([\w_]+))@(?P<domain>([\w\-\.]+[\w]+)(:[\d]+)?)$/x';

    protected string $username;

    protected string $domain;

    protected string $host;

    protected string $port;

    /**
     * @var string[]
     */
    protected array $aliases = [];

    /**
     * @var array<array<string, string>>
     */
    protected array $links = [];

    public function __construct(
        protected string $subject,
    ) {
        // Split resource into its parts (username, domain)
        $parts = $this->splitResource($subject);
        if (! $parts) {
            throw new Exception('Wrong WebFinger resource pattern.');
        }

        $username = $parts['username'];
        $domain = $parts['domain'];

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
            ! ($actor = model('ActorModel', false)->getActorByUsername($username, $domain)) instanceof Actor
        ) {
            throw new Exception('Could not find actor');
        }

        $this->aliases = [$actor->uri];
        $this->links = [
            [
                'rel'  => 'self',
                'type' => 'application/activity+json',
                'href' => $actor->uri,
            ],
            [
                'rel'  => 'http://webfinger.net/rel/profile-page',
                'type' => 'text/html',
                'href' => $actor->uri,
                # TODO: should there be 2 values? @actorUsername
            ],
        ];
    }

    /**
     * Get WebFinger response as an array
     *
     * @return array{subject: string, aliases: string[], links: array<mixed, array<string, string>>}
     */
    public function toArray(): array
    {
        return [
            'subject' => $this->subject,
            'aliases' => $this->aliases,
            'links'   => $this->links,
        ];
    }

    /**
     * Split resource into its parts (username, domain)
     *
     * @return array{0:string,username:non-empty-string,1:non-empty-string,2:non-empty-string,domain:non-falsy-string,3:non-falsy-string,4:non-falsy-string,5?:non-falsy-string}
     */
    private function splitResource(string $resource): bool|array
    {
        if (! preg_match(self::RESOURCE_PATTERN, $resource, $matches)) {
            // Resource pattern failed
            return false;
        }

        return $matches;
    }
}
