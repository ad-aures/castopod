<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Auth\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Entities\User;
use Modules\Admin\Controllers\BaseController;

class MyAccountController extends BaseController
{
    public function index(): string
    {
        $this->setHtmlHead(lang('MyAccount.info'));
        return view('my_account/view');
    }

    public function changePassword(): string
    {
        helper('form');

        $this->setHtmlHead(lang('MyAccount.changePassword'));
        return view('my_account/change_password');
    }

    public function changeAction(): RedirectResponse
    {
        $rules = [
            'password'     => 'required',
            'new_password' => 'required|strong_password|differs[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        // check credentials with the old password if logged in without magic link
        $credentials = [
            'email' => auth()
                ->user()
                ->email,
            'password' => $validData['password'],
        ];

        $validCreds = auth()
            ->check($credentials);

        if (! $validCreds->isOK()) {
            return redirect()->back()
                ->with('error', lang('MyAccount.messages.wrongPasswordError'));
        }

        $user = auth()
            ->user();

        if ($user instanceof User) {
            // set new password to user
            $user->password = $validData['new_password'];

            $userModel = auth()
                ->getProvider();
            $userModel->save($user);
        }

        // Success!
        return redirect()
            ->back()
            ->with('message', lang('MyAccount.messages.passwordChangeSuccess'));
    }
}
