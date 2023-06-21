<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Filters;

use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\Request;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Modules\Api\Rest\V1\Config\RestApi;

class ApiFilter implements FilterInterface
{
    /**
     * @param Request $request
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        /** @var RestApi $restApiConfig */
        $restApiConfig = config('RestApi');

        if (! $restApiConfig->enabled) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ($restApiConfig->basicAuth) {
            /** @var Response $response */
            $response = service('response');
            if (! $request->hasHeader('Authorization')) {
                $response->setStatusCode(401);

                return $response;
            }

            $authHeader = $request->getHeaderLine('Authorization');
            if (substr($authHeader, 0, 6) !== 'Basic ') {
                $response->setStatusCode(401);

                return $response;
            }

            $auth_token = base64_decode(substr($authHeader, 6), true);

            list($username, $password) = explode(':', (string) $auth_token);

            if (! ($username === $restApiConfig->basicAuthUsername && $password === $restApiConfig->basicAuthPassword)) {
                $response->setStatusCode(401);

                return $response;
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {
        // Do something here
    }
}
