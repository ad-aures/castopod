<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;

/** @property IncomingRequest  $request */
abstract class BaseApiController extends Controller
{
    use ResponseTrait;

    /**
     * Instance of the main Request object.
     *
     * @var IncomingRequest
     */
    protected $request;
}
