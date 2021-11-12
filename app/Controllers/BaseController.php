<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use ViewThemes\Theme;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components and performing functions that are needed by all
 * your controllers. Extend this class in any new controllers: class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Constructor.
     */
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void {
        $this->helpers = array_merge($this->helpers, ['auth', 'svg', 'components', 'misc', 'seo']);

        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        Theme::setTheme('app');
    }
}
