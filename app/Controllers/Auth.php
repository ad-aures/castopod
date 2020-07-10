<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use Myth\Auth\Models\UserModel;

class Auth extends \Myth\Auth\Controllers\AuthController
{
    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['auth'];

    /**
     * Displays the login form, or redirects
     * the user to their destination/home if
     * they are already logged in.
     */
    public function changePassword()
    {
        return view('auth/change_password', [
            'config' => $this->config,
            'email' => user()->email,
            'token' => user()->reset_hash,
        ]);
    }

    public function attemptChange()
    {
        $users = new UserModel();

        // First things first - log the reset attempt.
        $users->logResetAttempt(
            $this->request->getPost('email'),
            $this->request->getPost('token'),
            $this->request->getIPAddress(),
            (string) $this->request->getUserAgent()
        );

        $rules = [
            'token' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required|strong_password',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $users->errors());
        }

        $user = $users
            ->where('email', $this->request->getPost('email'))
            ->where('reset_hash', $this->request->getPost('token'))
            ->first();

        if (is_null($user)) {
            return redirect()
                ->back()
                ->with('error', lang('Auth.forgotNoUser'));
        }

        // Reset token still valid?
        if (
            !empty($user->reset_expires) &&
            time() > $user->reset_expires->getTimestamp()
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', lang('Auth.resetTokenExpired'));
        }

        // Success! Save the new password, and cleanup the reset hash.
        $user->password = $this->request->getPost('password');
        $user->reset_hash = null;
        $user->reset_at = date('Y-m-d H:i:s');
        $user->reset_expires = null;
        $user->force_pass_reset = false;
        $users->save($user);

        return redirect()
            ->route('login')
            ->with('message', lang('Auth.resetSuccess'));
    }
}
