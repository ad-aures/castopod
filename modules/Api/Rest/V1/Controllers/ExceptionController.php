<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class ExceptionController extends BaseApiController
{
    public function notFound(): ResponseInterface
    {
        return $this->failNotFound('Podcast not found');
    }
}
