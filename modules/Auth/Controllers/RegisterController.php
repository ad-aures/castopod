<?php

declare(strict_types=1);

namespace Modules\Auth\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Controllers\RegisterController as ShieldRegisterController;
use Override;
use Psr\Log\LoggerInterface;
use ViewThemes\Theme;

/**
 * Handles displaying registration form, and handling actual registration flow.
 */
class RegisterController extends ShieldRegisterController
{
    #[Override]
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);

        Theme::setTheme('auth');
    }
}
