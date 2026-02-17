<?php

declare(strict_types=1);

namespace Modules\Admin\Controllers;

use App\Libraries\HtmlHead;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Override;
use Psr\Log\LoggerInterface;
use ViewThemes\Theme;

/**
 * BaseController provides a convenient place for loading components and performing functions that are needed by all
 * your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */

abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var IncomingRequest
     */
    protected $request;

    #[Override]
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger,
    ): void {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        $this->helpers = [...$this->helpers, 'auth', 'breadcrumb', 'svg', 'components', 'misc'];

        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        Theme::setTheme('admin');
    }

    protected function setHtmlHead(string $title): void
    {
        /** @var HtmlHead $head */
        $head = service('html_head');

        $head
            ->title($title . ' | Castopod Admin')
            ->description(
                'Castopod is an open-source hosting platform made for podcasters who want engage and interact with their audience.',
            );
    }
}
