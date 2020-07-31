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
            $user_model = new UserModel();
            if (!($this->user = $user_model->find($params[0]))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

        return $this->$method();
    }

    public function list()
    {
        $data = ['all_users' => (new UserModel())->findAll()];

        return view('admin/user/list', $data);
    }

    public function create()
    {
        $data = [
            'roles' => (new GroupModel())->getUserRoles(),
        ];

        echo view('admin/user/create', $data);
    }

    public function attemptCreate()
    {
        $user_model = new UserModel();

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = array_merge(
            $user_model->getValidationRules(['only' => ['username']]),
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

        if (!$user_model->save($user)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $user_model->errors());
        }

        // Success!
        return redirect()
            ->route('user_list')
            ->with(
                'message',
                lang('User.createSuccess', [
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

        echo view('admin/user/edit', $data);
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
                lang('User.rolesEditSuccess', [
                    'username' => $this->user->username,
                ])
            );
    }

    public function forcePassReset()
    {
        $user_model = new UserModel();
        $this->user->forcePasswordReset();

        if (!$user_model->save($this->user)) {
            return redirect()
                ->back()
                ->with('errors', $user_model->errors());
        }

        // Success!
        return redirect()
            ->route('user_list')
            ->with(
                'message',
                lang('User.forcePassResetSuccess', [
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
                    lang('User.banSuperAdminError', [
                        'username' => $this->user->username,
                    ]),
                ]);
        }

        $user_model = new UserModel();
        // TODO: add ban reason?
        $this->user->ban('');

        if (!$user_model->save($this->user)) {
            return redirect()
                ->back()
                ->with('errors', $user_model->errors());
        }

        return redirect()
            ->route('user_list')
            ->with(
                'message',
                lang('User.banSuccess', [
                    'username' => $this->user->username,
                ])
            );
    }

    public function unBan()
    {
        $user_model = new UserModel();
        $this->user->unBan();

        if (!$user_model->save($this->user)) {
            return redirect()
                ->back()
                ->with('errors', $user_model->errors());
        }

        return redirect()
            ->route('user_list')
            ->with(
                'message',
                lang('User.unbanSuccess', [
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
                    lang('User.deleteSuperAdminError', [
                        'username' => $this->user->username,
                    ]),
                ]);
        }

        $user_model = new UserModel();
        $user_model->delete($this->user->id);

        return redirect()
            ->back()
            ->with(
                'message',
                lang('User.deleteSuccess', [
                    'username' => $this->user->username,
                ])
            );
    }
}
