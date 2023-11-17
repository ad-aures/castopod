<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Auth\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\I18n\Time;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Exceptions\ValidationException;
use CodeIgniter\Shield\Models\UserIdentityModel;
use Modules\Admin\Controllers\BaseController;
use Modules\Auth\Models\UserModel;

class UserController extends BaseController
{
    protected ?User $user;

    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            return $this->{$method}();
        }

        if (($this->user = (new UserModel())->find($params[0])) instanceof User) {
            return $this->{$method}();
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function list(): string
    {
        $data = [
            'users' => (new UserModel())->findAll(),
        ];

        return view('user/list', $data);
    }

    public function view(): string
    {
        $data = [
            'user' => $this->user,
        ];

        replace_breadcrumb_params([
            0 => $this->user->username,
        ]);
        return view('user/view', $data);
    }

    public function create(): string
    {
        helper('form');

        $roles = setting('AuthGroups.instanceGroups');
        $roleOptions = [];
        array_walk(
            $roles,
            static function (array $role, $key) use (&$roleOptions): array {
                $roleOptions[$key] = $role['title'];
                return $roleOptions;
            },
            [],
        );

        $data = [
            'roleOptions' => $roleOptions,
        ];

        return view('user/create', $data);
    }

    /**
     * Create the user with the provided username and email. The password is set as a random string and a magic link is
     * sent to the user to allow them setting their password.
     */
    public function attemptCreate(): RedirectResponse
    {
        helper(['text', 'email']);

        $db = db_connect();
        $db->transStart();

        $userModel = new UserModel();

        // Save the user
        $email = $this->request->getPost('email');
        $user = new User([
            'username' => $this->request->getPost('username'),
            'email'    => $email,
            // set a random password
            // user will be prompted to change it on first magic link login.
            'password' => random_string('alnum', 32),
        ]);
        try {
            $userModel->save($user);
        } catch (ValidationException) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $userModel->errors());
        }

        $user = $userModel->findById($userModel->getInsertID());
        $user->addGroup($this->request->getPost('role'));

        // **** SEND WELCOME LINK FOR FIRST LOGIN ****

        /** @var UserIdentityModel $identityModel */
        $identityModel = model(UserIdentityModel::class);

        // Delete any previous magic-link identities
        $identityModel->deleteIdentitiesByType($user, Session::ID_TYPE_MAGIC_LINK);

        // Generate the code and save it as an identity
        $token = random_string('crypto', 20);

        $identityModel->insert([
            'user_id' => $user->id,
            'type'    => Session::ID_TYPE_MAGIC_LINK,
            'secret'  => $token,
            'expires' => Time::now()->addSeconds(setting('Auth.welcomeLinkLifetime'))->format('Y-m-d H:i:s'),
        ]);

        // Send the user an email with the code
        $email = emailer()
            ->setFrom(setting('Email.fromEmail'), setting('Email.fromName') ?? '');
        $email->setTo($user->email);
        $email->setSubject(lang('Auth.welcomeSubject', [
            'siteName' => setting('App.siteName'),
        ], null, false));
        $email->setMessage(view(setting('Auth.views')['welcome-email'], [
            'token' => $token,
        ], [
            'theme' => 'auth',
        ]));

        if (! $email->send(false)) {
            log_message('error', $email->printDebugger(['headers']));

            return redirect()->back()
                ->with('error', lang('Auth.unableSendEmailToUser', [$user->email]));
        }

        // Clear the email
        $email->clear();

        $db->transComplete();

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

        $roles = setting('AuthGroups.instanceGroups');
        $roleOptions = [];
        array_walk(
            $roles,
            static function (array $role, $key) use (&$roleOptions): array {
                $roleOptions[$key] = $role['title'];
                return $roleOptions;
            },
            [],
        );

        $data = [
            'user'        => $this->user,
            'roleOptions' => $roleOptions,
        ];

        replace_breadcrumb_params([
            0 => $this->user->username,
        ]);
        return view('user/edit', $data);
    }

    public function attemptEdit(): RedirectResponse
    {
        // The instance owner is a superadmin and the only user that cannot be demoted.
        if ((bool) $this->user->is_owner) {
            return redirect()
                ->back()
                ->with('errors', [
                    lang('User.messages.editOwnerError', [
                        'username' => $this->user->username,
                    ]),
                ]);
        }

        $group = $this->request->getPost('role');

        set_instance_group($this->user, $group);

        // Success!
        return redirect()
            ->route('user-list')
            ->with('message', lang('User.messages.roleEditSuccess', [
                'username' => $this->user->username,
            ]));
    }

    public function delete(): string
    {
        helper(['form']);

        $data = [
            'user' => $this->user,
        ];

        replace_breadcrumb_params([
            0 => $this->user->username,
        ]);
        return view('user/delete', $data);
    }

    public function attemptDelete(): RedirectResponse
    {
        // You cannot delete the instance owner.
        if ((bool) $this->user->is_owner) {
            return redirect()
                ->back()
                ->with('errors', [
                    lang('User.messages.deleteOwnerError', [
                        'username' => $this->user->username,
                    ]),
                ]);
        }

        // You cannot delete a superadmin
        // superadmin has to be demoted before being deleted
        if ($this->user->inGroup(setting('AuthGroups.mostPowerfulPodcastGroup'))) {
            return redirect()
                ->back()
                ->with('errors', [
                    lang('User.messages.deleteSuperAdminError', [
                        'username' => $this->user->username,
                    ]),
                ]);
        }

        $rules = [
            'understand' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        (new UserModel())->delete($this->user->id, true);

        return redirect()
            ->route('user-list')
            ->with('message', lang('User.messages.deleteSuccess', [
                'username' => $this->user->username,
            ]));
    }
}
