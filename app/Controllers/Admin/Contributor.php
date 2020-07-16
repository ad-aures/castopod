<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Models\PodcastModel;
use Myth\Auth\Authorization\GroupModel;
use Myth\Auth\Config\Services;
use Myth\Auth\Models\UserModel;

class Contributor extends BaseController
{
    protected \App\Entities\Podcast $podcast;
    protected ?\Myth\Auth\Entities\User $user;

    public function _remap($method, ...$params)
    {
        if (
            !has_permission('podcasts-manage_contributors') ||
            !has_permission("podcasts:$params[0]-manage_contributors")
        ) {
            throw new \RuntimeException(lang('Auth.notEnoughPrivilege'));
        }

        $podcast_model = new PodcastModel();

        $this->podcast = $podcast_model->find($params[0]);

        if (count($params) > 1) {
            $user_model = new UserModel();
            if (
                !($this->user = $user_model
                    ->select('users.*')
                    ->join(
                        'users_podcasts',
                        'users_podcasts.user_id = users.id'
                    )
                    ->where([
                        'users.id' => $params[1],
                        'podcast_id' => $params[0],
                    ])
                    ->first())
            ) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

        return $this->$method();
    }

    public function list()
    {
        $data = [
            'podcast' => $this->podcast,
        ];

        echo view('admin/contributor/list', $data);
    }

    public function add()
    {
        $user_model = new UserModel();
        $group_model = new GroupModel();

        $roles = $group_model
            ->select('auth_groups.*')
            ->like('name', 'podcasts:' . $this->podcast->id, 'after')
            ->findAll();

        $data = [
            'podcast' => $this->podcast,
            'users' => $user_model->findAll(),
            'roles' => $roles,
        ];

        echo view('admin/contributor/add', $data);
    }

    public function attemptAdd()
    {
        $authorize = Services::authorization();

        $user_id = (int) $this->request->getPost('user');
        $group_id = (int) $this->request->getPost('role');

        // Add user to chosen group
        $authorize->addUserToGroup($user_id, $group_id);

        (new PodcastModel())->addContributorToPodcast(
            $user_id,
            $this->podcast->id
        );

        return redirect()->route('contributor_list', [$this->podcast->id]);
    }

    public function edit()
    {
        $group_model = new GroupModel();

        $roles = $group_model
            ->select('auth_groups.*')
            ->like('name', 'podcasts:' . $this->podcast->id, 'after')
            ->findAll();

        $user_role = $group_model
            ->select('auth_groups.*')
            ->join(
                'auth_groups_users',
                'auth_groups_users.group_id = auth_groups.id'
            )
            ->where('auth_groups_users.user_id', $this->user->id)
            ->like('name', 'podcasts:' . $this->podcast->id, 'after')
            ->first();

        $data = [
            'podcast' => $this->podcast,
            'user' => $this->user,
            'user_role' => $user_role,
            'roles' => $roles,
        ];

        echo view('admin/contributor/edit', $data);
    }

    public function attemptEdit()
    {
        $authorize = Services::authorization();

        $group_model = new GroupModel();

        $group = $group_model
            ->select('auth_groups.*')
            ->join(
                'auth_groups_users',
                'auth_groups_users.group_id = auth_groups.id'
            )
            ->where('user_id', $this->user->id)
            ->like('name', 'podcasts:' . $this->podcast->id, 'after')
            ->first();

        $authorize->removeUserFromGroup(
            (int) $this->user->id,
            (int) $group->id
        );

        $authorize->addUserToGroup(
            (int) $this->user->id,
            (int) $this->request->getPost('role')
        );

        return redirect()->route('contributor_list', [$this->podcast->id]);
    }

    public function remove()
    {
        $authorize = Services::authorization();

        $group_model = new GroupModel();

        $group = $group_model
            ->select('auth_groups.*')
            ->join(
                'auth_groups_users',
                'auth_groups_users.group_id = auth_groups.id'
            )
            ->like('name', 'podcasts:' . $this->podcast->id, 'after')
            ->where('user_id', $this->user->id)
            ->first();

        $authorize->removeUserFromGroup(
            (int) $this->user->id,
            (int) $group->id
        );

        (new PodcastModel())->removeContributorFromPodcast(
            $this->user->id,
            $this->podcast->id
        );

        return redirect()->route('contributor_list', [$this->podcast->id]);
    }
}
