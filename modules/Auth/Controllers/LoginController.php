<?php

declare(strict_types=1);

namespace Modules\Auth\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Controllers\LoginController as ShieldLoginController;
use Override;
use Psr\Log\LoggerInterface;
use ViewThemes\Theme;

class LoginController extends ShieldLoginController
{
    #[Override]
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger,
    ): void {
        parent::initController($request, $response, $logger);

        Theme::setTheme('auth');
    }
}
