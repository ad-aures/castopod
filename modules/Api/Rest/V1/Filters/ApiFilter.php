<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Filters;


use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ApiFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null): void
    {
        $restApiConfig = config('RestApi');

        if (! config('RestApi')->enabled) {
            throw PageNotFoundException::forPageNotFound();
        }

        $authHeader = $request->getHeaderLine('Authorization');

        if($restApiConfig->basicAuth) {
            if (!empty($authHeader) && substr($authHeader, 0, 6) === 'Basic ') {
                $auth_token = base64_decode(substr($authHeader, 6));
                list($username, $password) = explode(':', $auth_token);

                if( ! ($username == $restApiConfig->username && $password === $restApiConfig->password)) {
                    throw new \Exception('Unauthorized');
                }

            } else {
                throw new \Exception('Unauthorized');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {
        // Do something here
    }
}
