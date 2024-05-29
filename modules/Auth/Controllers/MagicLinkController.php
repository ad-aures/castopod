<?php

declare(strict_types=1);

namespace Modules\Auth\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Controllers\MagicLinkController as ShieldMagicLinkController;
use CodeIgniter\Shield\Entities\User;
use Override;
use Psr\Log\LoggerInterface;
use ViewThemes\Theme;

/**
 * Handles "Magic Link" logins - an email-based no-password login protocol. This works much like password reset would,
 * but Shield provides this in place of password reset. It can also be used on it's own without an email/password login
 * strategy.
 */
class MagicLinkController extends ShieldMagicLinkController
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

    public function setPasswordView(): string | RedirectResponse
    {
        if (! session('magicLogin')) {
            return redirect()->to(config('Auth')->loginRedirect());
        }

        return view(setting('Auth.views')['magic-link-set-password']);
    }

    public function setPasswordAction(): RedirectResponse
    {
        $rules = [
            'new_password' => 'required|strong_password',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        $user = auth()
            ->user();

        if ($user instanceof User) {
            // set new password to user
            $user->password = $validData['new_password'];

            $userModel = auth()
                ->getProvider();
            $userModel->save($user);
        }

        // remove magic login session to reinstate normal check
        if (session('magicLogin')) {
            session()->removeTempdata('magicLogin');
        }

        // Success!
        return redirect()->to(config('Auth')->loginRedirect())
            ->with('message', lang('MyAccount.messages.passwordChangeSuccess'));
    }
}
