<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Authorization\GroupModel;
use App\Entities\User;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

class UserController extends BaseController
{
    protected ?User $user;

    public function _remap(string $method, string ...$params): mixed
    {
        if (count($params) === 0) {
            return $this->{$method}();
        }

        if ($this->user = (new UserModel())->find($params[0])) {
            return $this->{$method}();
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function list(): string
    {
        $data = [
            'users' => (new UserModel())->findAll(),
        ];

        return view('admin/user/list', $data);
    }

    public function view(): string
    {
        $data = [
            'user' => $this->user,
        ];

        replace_breadcrumb_params([
            0 => $this->user->username,
        ]);
        return view('admin/user/view', $data);
    }

    public function create(): string
    {
        helper('form');

        $data = [
            'roles' => (new GroupModel())->getUserRoles(),
        ];

        return view('admin/user/create', $data);
    }

    public function attemptCreate(): RedirectResponse
    {
        $userModel = new UserModel();

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = array_merge(
            $userModel->getValidationRules([
                'only' => ['username'],
            ]),
            [
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|strong_password',
            ],
        );

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Save the user
        $user = new User($this->request->getPost());

        // Activate user
        $user->activate();

        // Force user to reset his password on first connection
        $user->forcePasswordReset();

        if (! $userModel->insert($user)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $userModel->errors());
        }

        // Success!
        return redirect()
            ->route('user-list')
            ->with('message', lang('User.messages.createSuccess', [
                'username' => $user->username,
            ]));
    }

    public function edit(): string
    {
        helper('form');

        $roles = (new GroupModel())->getUserRoles();
        $roleOptions = array_reduce(
            $roles,
            function ($result, $role) {
                $result[$role->name] = lang('User.roles.' . $role->name);
                return $result;
            },
            [],
        );

        $data = [
            'user' => $this->user,
            'roleOptions' => $roleOptions,
        ];

        replace_breadcrumb_params([
            0 => $this->user->username,
        ]);
        return view('admin/user/edit', $data);
    }

    public function attemptEdit(): RedirectResponse
    {
        $authorize = Services::authorization();

        $roles = $this->request->getPost('roles');
        $authorize->setUserGroups($this->user->id, $roles);

        // Success!
        return redirect()
            ->route('user-list')
            ->with('message', lang('User.messages.rolesEditSuccess', [
                'username' => $this->user->username,
            ]));
    }

    public function forcePassReset(): RedirectResponse
    {
        $userModel = new UserModel();
        $this->user->forcePasswordReset();

        if (! $userModel->update($this->user->id, $this->user)) {
            return redirect()
                ->back()
                ->with('errors', $userModel->errors());
        }

        // Success!
        return redirect()
            ->route('user-list')
            ->with(
                'message',
                lang('User.messages.forcePassResetSuccess', [
                    'username' => $this->user->username,
                ]),
            );
    }

    public function ban(): RedirectResponse
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

        if (! $userModel->update($this->user->id, $this->user)) {
            return redirect()
                ->back()
                ->with('errors', $userModel->errors());
        }

        return redirect()
            ->route('user-list')
            ->with('message', lang('User.messages.banSuccess', [
                'username' => $this->user->username,
            ]));
    }

    public function unBan(): RedirectResponse
    {
        $userModel = new UserModel();
        $this->user->unBan();

        if (! $userModel->update($this->user->id, $this->user)) {
            return redirect()
                ->back()
                ->with('errors', $userModel->errors());
        }

        return redirect()
            ->route('user-list')
            ->with('message', lang('User.messages.unbanSuccess', [
                'username' => $this->user->username,
            ]));
    }

    public function delete(): RedirectResponse
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
            ->with('message', lang('User.messages.deleteSuccess', [
                'username' => $this->user->username,
            ]));
    }
}
