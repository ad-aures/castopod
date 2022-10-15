<?php

declare(strict_types=1);

namespace Modules\Auth\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Controllers\ActionController as ShieldActionController;
use Psr\Log\LoggerInterface;
use ViewThemes\Theme;

/**
 * Class ActionController
 *
 * A generic controller to handle Authentication Actions.
 */
class ActionController extends ShieldActionController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);

        Theme::setTheme('auth');
    }
}
