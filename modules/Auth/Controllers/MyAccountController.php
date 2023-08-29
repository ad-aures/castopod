<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Auth\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use Modules\Admin\Controllers\BaseController;
use Modules\Auth\Models\UserModel;

class MyAccountController extends BaseController
{
    public function index(): string
    {
        return view('my_account/view');
    }

    public function changePassword(): string
    {
        helper('form');

        return view('my_account/change_password');
    }

    public function attemptChange(): RedirectResponse
    {
        $rules = [
            'password'     => 'required',
            'new_password' => 'required|strong_password|differs[password]',
        ];

        $userModel = new UserModel();
        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $userModel->errors());
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

        // set new password to user
        auth()
            ->user()
            ->password = $validData['new_password'];

        if (! $userModel->update(auth()->user()->id, auth()->user())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $userModel->errors());
        }

        // Success!
        return redirect()
            ->back()
            ->with('message', lang('MyAccount.messages.passwordChangeSuccess'));
    }
}
