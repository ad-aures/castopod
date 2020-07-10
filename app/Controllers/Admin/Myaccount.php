<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use Myth\Auth\Config\Services;
use Myth\Auth\Models\UserModel;

class Myaccount extends BaseController
{
    public function index()
    {
        return view('admin/my_account/view');
    }

    public function changePassword()
    {
        return view('admin/my_account/change_password');
    }

    public function attemptChange()
    {
        $auth = Services::authentication();
        $user_model = new UserModel();

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required',
            'new_password' => 'required|strong_password',
            'new_pass_confirm' => 'required|matches[new_password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $user_model->errors());
        }

        $credentials = [
            'email' => user()->email,
            'password' => $this->request->getPost('password'),
        ];

        if (!$auth->validate($credentials)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $user_model->errors());
        }

        user()->password = $this->request->getPost('new_password');
        $user_model->save(user());

        if (!$user_model->save(user())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $user_model->errors());
        }

        // Success!
        return redirect()
            ->route('myAccount')
            ->with('message', lang('MyAccount.passwordChangeSuccess'));
    }
}
