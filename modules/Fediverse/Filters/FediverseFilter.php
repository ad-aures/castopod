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

class FediverseFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do. By default it should not return anything during normal execution.
     * However, when an abnormal state is found, it should return an instance of CodeIgniter\HTTP\Response. If it does,
     * script execution will end and that Response will be sent back to the client, allowing for error pages, redirects,
     * etc.
     *
     * @param string[]|null                         $params
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $params = null)
    {
        if ($params === null) {
            return;
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
            $domain = (new URI($actorUri))->getHost();

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
                (new HttpSignature())->verify();
            } catch (Exception) {
                // Invalid HttpSignature (401 = unauthorized)
                // TODO: show error message?
                return service('response')->setStatusCode(401);
            }
        }
    }

    //--------------------------------------------------------------------

    /**
     * Allows After filters to inspect and modify the response object as needed. This method does not allow any way to
     * stop execution of other after filters, short of throwing an Exception or Error.
     *
     * @param string[]|null                          $arguments
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {
    }

    //--------------------------------------------------------------------
}
