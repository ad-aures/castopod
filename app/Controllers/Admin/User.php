<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Authorization\GroupModel;
use App\Models\UserModel;
use Config\Services;

class User extends BaseController
{
    protected ?\App\Entities\User $user;

    public function _remap($method, ...$params)
    {
        if (count($params) > 0) {
            if (!($this->user = (new UserModel())->find($params[0]))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

        return $this->$method();
    }

    public function list()
    {
        $data = ['users' => (new UserModel())->findAll()];

        return view('admin/user/list', $data);
    }

    public function view()
    {
        $data = ['user' => $this->user];

        replace_breadcrumb_params([0 => $this->user->username]);
        return view('admin/user/view', $data);
    }

    public function create()
    {
        $data = [
            'roles' => (new GroupModel())->getUserRoles(),
        ];

        return view('admin/user/create', $data);
    }

    public function attemptCreate()
    {
        $userModel = new UserModel();

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = array_merge(
            $userModel->getValidationRules(['only' => ['username']]),
            [
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|strong_password',
                'pass_confirm' => 'required|matches[password]',
            ]
        );

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Save the user
        $user = new \App\Entities\User($this->request->getPost());

        // Activate user
        $user->activate();

        // Force user to reset his password on first connection
        $user->forcePasswordReset();

        if (!$userModel->save($user)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $userModel->errors());
        }

        // Success!
        return redirect()
            ->route('user_list')
            ->with(
                'message',
                lang('User.messages.createSuccess', [
                    'username' => $user->username,
                ])
            );
    }

    public function edit()
    {
        $data = [
            'user' => $this->user,
            'roles' => (new GroupModel())->getUserRoles(),
        ];

        replace_breadcrumb_params([0 => $this->user->username]);
        return view('admin/user/edit', $data);
    }

    public function attemptEdit()
    {
        $authorize = Services::authorization();

        $roles = $this->request->getPost('roles');
        $authorize->setUserGroups($this->user->id, $roles);

        // Success!
        return redirect()
            ->route('user_list')
            ->with(
                'message',
                lang('User.messages.rolesEditSuccess', [
                    'username' => $this->user->username,
                ])
            );
    }

    public function forcePassReset()
    {
        $userModel = new UserModel();
        $this->user->forcePasswordReset();

        if (!$userModel->save($this->user)) {
            return redirect()
                ->back()
                ->with('errors', $userModel->errors());
        }

        // Success!
        return redirect()
            ->route('user_list')
            ->with(
                'message',
                lang('User.messages.forcePassResetSuccess', [
                    'username' => $this->user->username,
                ])
            );
    }

    public function ban()
    {
        $authorize = Services::authorization();
        if ($authorize->inGroup('superadmin', $this->user->id)) {
            return redirect()
                ->back()
                ->with('errors', [
                    lang('User.messages.banSuperAdminError', [
                        'username' => $this->user->username,
                    ]),
                ]);
        }

        $userModel = new UserModel();
        // TODO: add ban reason?
        $this->user->ban('');

        if (!$userModel->save($this->user)) {
            return redirect()
                ->back()
                ->with('errors', $userModel->errors());
        }

        return redirect()
            ->route('user_list')
            ->with(
                'message',
                lang('User.messages.banSuccess', [
                    'username' => $this->user->username,
                ])
            );
    }

    public function unBan()
    {
        $userModel = new UserModel();
        $this->user->unBan();

        if (!$userModel->save($this->user)) {
            return redirect()
                ->back()
                ->with('errors', $userModel->errors());
        }

        return redirect()
            ->route('user_list')
            ->with(
                'message',
                lang('User.messages.unbanSuccess', [
                    'username' => $this->user->username,
                ])
            );
    }

    public function delete()
    {
        $authorize = Services::authorization();
        if ($authorize->inGroup('superadmin', $this->user->id)) {
            return redirect()
                ->back()
                ->with('errors', [
                    lang('User.messages.deleteSuperAdminError', [
                        'username' => $this->user->username,
                    ]),
                ]);
        }

        (new UserModel())->delete($this->user->id);

        return redirect()
            ->back()
            ->with(
                'message',
                lang('User.messages.deleteSuccess', [
                    'username' => $this->user->username,
                ])
            );
    }
}
