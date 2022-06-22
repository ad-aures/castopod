<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Response;

class ExceptionController extends Controller
{
    use ResponseTrait;

    public function notFound(): Response
    {
        return $this->failNotFound('Podcast not found');
    }
}
