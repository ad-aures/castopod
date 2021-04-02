<?php

namespace ActivityPub\Filters;

use ActivityPub\HttpSignature;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\URI;

class ActivityPubFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param \CodeIgniter\HTTP\RequestInterface $request
     * @param array|null                         $params
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $params = null)
    {
        if (empty($params)) {
            return;
        }

        if (in_array('verify-activitystream', $params)) {
            $negotiate = \Config\Services::negotiator();

            $allowedContentTypes = [
                'application/ld+json; profile="https://www.w3.org/ns/activitystreams',
                'application/activity+json',
            ];

            if (empty($negotiate->media($allowedContentTypes))) {
                // return $this->response->setStatusCode(415)->setJSON([]);
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

        if (in_array('verify-blocks', $params)) {
            $payload = $request->getJSON();

            $actorUri = $payload->actor;
            $domain = (new URI($actorUri))->getHost();

            // check first if domain is blocked
            if (model('BlockedDomainModel')->isDomainBlocked($domain)) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            // check if actor is blocked
            if (model('ActorModel')->isActorBlocked($actorUri)) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

        if (in_array('verify-signature', $params)) {
            try {
                // securityCheck: check activity signature before handling it
                (new HttpSignature())->verify();
            } catch (\Exception $e) {
                // Invalid HttpSignature (401 = unauthorized)
                // TODO: show error message?
                return service('response')->setStatusCode(401);
            }
        }
    }

    //--------------------------------------------------------------------

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param \CodeIgniter\HTTP\RequestInterface  $request
     * @param \CodeIgniter\HTTP\ResponseInterface $response
     * @param array|null                          $arguments
     *
     * @return void
     */
    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
    }

    //--------------------------------------------------------------------
}
