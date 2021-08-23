<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

class MyAccountController extends BaseController
{
    public function index(): string
    {
        return view('Modules\Admin\Views\my_account\view');
    }

    public function changePassword(): string
    {
        helper('form');

        return view('Modules\Admin\Views\my_account\change_password');
    }

    public function attemptChange(): RedirectResponse
    {
        $auth = Services::authentication();
        $userModel = new UserModel();

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = [
            'password' => 'required',
            'new_password' => 'required|strong_password|differs[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $userModel->errors());
        }

        $credentials = [
            'email' => user()
                ->email,
            'password' => $this->request->getPost('password'),
        ];

        if (! $auth->validate($credentials)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', lang('MyAccount.messages.wrongPasswordError'));
        }

        user()
            ->password = $this->request->getPost('new_password');

        if (! $userModel->update(user_id(), user())) {
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
