<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Override;
use Psr\Log\LoggerInterface;
use ViewThemes\Theme;

/**
 * BaseController provides a convenient place for loading components and performing functions that are needed by all
 * your controllers. Extend this class in any new controllers: class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var IncomingRequest
     */
    protected $request;

    /**
     * Instance of the main response object.
     *
     * @var Response
     */
    protected $response;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    #[Override]
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void {
        $this->helpers = [...$this->helpers, 'svg', 'components', 'misc', 'seo', 'premium_podcasts'];

        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        Theme::setTheme('app');
    }
}
