<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use Myth\Auth\Models\UserModel;

class User extends BaseController
{
    protected ?\Myth\Auth\Entities\User $user;

    public function _remap($method, ...$params)
    {
        if (count($params) > 0) {
            $user_model = new UserModel();
            if (
                !($user = $user_model->where('username', $params[0])->first())
            ) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            $this->user = $user;
        }

        return $this->$method();
    }

    public function list()
    {
        $user_model = new UserModel();

        $data = ['all_users' => $user_model->findAll()];

        return view('admin/user/list', $data);
    }

    public function create()
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
            echo view('admin/user/create');
        } else {
            // Save the user
            $user = new \Myth\Auth\Entities\User($this->request->getPost());

            // Activate user
            $user->activate();

            // Force user to reset his password on first connection
            $user->force_pass_reset = true;
            $user->generateResetHash();

            if (!$user_model->save($user)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $user_model->errors());
            }

            // Success!
            return redirect()
                ->route('user_list')
                ->with('message', lang('User.createSuccess'));
        }
    }

    public function forcePassReset()
    {
        $user_model = new UserModel();

        $this->user->force_pass_reset = true;
        $this->user->generateResetHash();

        if (!$user_model->save($this->user)) {
            return redirect()
                ->back()
                ->with('errors', $user_model->errors());
        }

        // Success!
        return redirect()
            ->route('user_list')
            ->with('message', lang('User.forcePassResetSuccess'));
    }

    public function ban()
    {
        $user_model = new UserModel();
        $this->user->ban('');

        if (!$user_model->save($this->user)) {
            return redirect()
                ->back()
                ->with('errors', $user_model->errors());
        }

        return redirect()
            ->route('user_list')
            ->with('message', lang('User.banSuccess'));
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
            ->with('message', lang('User.unbanSuccess'));
    }

    public function delete()
    {
        $user_model = new UserModel();
        $user_model->delete($this->user->id);

        return redirect()
            ->route('user_list')
            ->with('message', lang('User.deleteSuccess'));
    }
}
