<?php

declare(strict_types=1);

namespace Modules\Fediverse\Filters;

use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\URI;
use Exception;
use Modules\Fediverse\HttpSignature;
use Override;

class FediverseFilter implements FilterInterface
{
    /**
     * @param string[]|null $params
     *
     * @return RequestInterface|ResponseInterface|string|null
     */
    #[Override]
    public function before(RequestInterface $request, $params = null)
    {
        if ($params === null) {
            return null;
        }

        if (in_array('verify-activitystream', $params, true)) {
            $negotiate = service('negotiator');

            $allowedContentTypes = [
                'application/ld+json; profile="https://www.w3.org/ns/activitystreams',
                'application/activity+json',
            ];

            if ($negotiate->media($allowedContentTypes) === '') {
                throw PageNotFoundException::forPageNotFound();
            }
        }

        if (in_array('verify-blocks', $params, true)) {
            // @phpstan-ignore-next-line
            $payload = $request->getJSON();

            $actorUri = $payload->actor;
            $domain = new URI($actorUri)
                ->getHost();

            // check first if domain is blocked
            if (model('BlockedDomainModel', false)->isDomainBlocked($domain)) {
                throw PageNotFoundException::forPageNotFound();
            }

            // check if actor is blocked
            if (model('ActorModel', false)->isActorBlocked($actorUri)) {
                throw PageNotFoundException::forPageNotFound();
            }
        }

        if (in_array('verify-signature', $params, true)) {
            try {
                // securityCheck: check activity signature before handling it
                new HttpSignature()
                    ->verify();
            } catch (Exception) {
                // Invalid HttpSignature (401 = unauthorized)
                // TODO: show error message?
                return service('response')->setStatusCode(401);
            }
        }

        return null;
    }

    /**
     * @param string[]|null $arguments
     *
     * @return ResponseInterface|null
     */
    #[Override]
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }
}
