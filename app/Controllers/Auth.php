<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Entities\User;

class Auth extends \Myth\Auth\Controllers\AuthController
{
    /**
     * Attempt to register a new user.
     */
    public function attemptRegister()
    {
        // Check if registration is allowed
        if (!$this->config->allowRegistration) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', lang('Auth.registerDisabled'));
        }

        $users = model('UserModel');

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = [
            'username' =>
                'required|alpha_numeric_space|min_length[3]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|strong_password',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', service('validation')->getErrors());
        }

        // Save the user
        $allowedPostFields = array_merge(
            ['password'],
            $this->config->validFields,
            $this->config->personalFields
        );
        $user = new User($this->request->getPost($allowedPostFields));

        $this->config->requireActivation !== false
            ? $user->generateActivateHash()
            : $user->activate();

        // Ensure default group gets assigned if set
        if (!empty($this->config->defaultUserGroup)) {
            $users = $users->withGroup($this->config->defaultUserGroup);
        }

        if (!$users->save($user)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $users->errors());
        }

        if ($this->config->requireActivation !== false) {
            $activator = service('activator');
            $sent = $activator->send($user);

            if (!$sent) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        $activator->error() ?? lang('Auth.unknownError')
                    );
            }

            // Success!
            return redirect()
                ->route('login')
                ->with('message', lang('Auth.activationSuccess'));
        }

        // Success!
        return redirect()
            ->route('login')
            ->with('message', lang('Auth.registerSuccess'));
    }

    /**
     * Verifies the code with the email and saves the new password,
     * if they all pass validation.
     *
     * @return mixed
     */
    public function attemptReset()
    {
        if ($this->config->activeResetter === false) {
            return redirect()
                ->route('login')
                ->with('error', lang('Auth.forgotDisabled'));
        }

        $users = model('UserModel');

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
