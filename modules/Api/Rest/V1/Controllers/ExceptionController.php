<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class ExceptionController extends Controller
{
    use ResponseTrait;

    public function notFound(): ResponseInterface
    {
        return $this->failNotFound('Podcast not found');
    }
}
