<?php

declare(strict_types=1);

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Override;

class AllowCorsFilter implements FilterInterface
{
    /**
     * @param list<string>|null $arguments
     *
     * @return RequestInterface|ResponseInterface|string|null
     */
    #[Override]
    public function before(RequestInterface $request, $arguments = null)
    {
        return null;
    }

    /**
     * @param list<string>|null $arguments
     *
     * @return ResponseInterface|null
     */
    #[Override]
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (! $response->hasHeader('Cache-Control')) {
            $response->setHeader('Cache-Control', 'public, max-age=86400');
        }

        $response->setHeader('Access-Control-Allow-Origin', '*') // for allowing any domain, insecure
            ->setHeader('Access-Control-Allow-Headers', '*') // for allowing any headers, insecure
            ->setHeader('Access-Control-Allow-Methods', 'GET, OPTIONS') // allows GET and OPTIONS methods only
            ->setHeader('Access-Control-Max-Age', '86400');

        return $response;
    }
}
