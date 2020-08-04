<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Authorization\GroupModel;
use App\Models\PodcastModel;
use App\Models\UserModel;

class Contributor extends BaseController
{
    protected \App\Entities\Podcast $podcast;
    protected ?\App\Entities\User $user;

    public function _remap($method, ...$params)
    {
        $this->podcast = (new PodcastModel())->find($params[0]);

        if (count($params) > 1) {
            if (
                !($this->user = (new UserModel())->getPodcastContributor(
                    $params[1],
                    $params[0]
                ))
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
        $data = [
            'podcast' => $this->podcast,
            'users' => (new UserModel())->findAll(),
            'roles' => (new GroupModel())->getContributorRoles(),
        ];

        echo view('admin/contributor/add', $data);
    }

    public function attemptAdd()
    {
        try {
            (new PodcastModel())->addPodcastContributor(
                $this->request->getPost('user'),
                $this->podcast->id,
                $this->request->getPost('role')
            );
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    lang('Contributor.messages.alreadyAddedError'),
                ]);
        }

        return redirect()->route('contributor_list', [$this->podcast->id]);
    }

    public function edit()
    {
        $data = [
            'podcast' => $this->podcast,
            'user' => $this->user,
            'contributorGroupId' => (new PodcastModel())->getContributorGroupId(
                $this->user->id,
                $this->podcast->id
            ),
            'roles' => (new GroupModel())->getContributorRoles(),
        ];

        echo view('admin/contributor/edit', $data);
    }

    public function attemptEdit()
    {
        (new PodcastModel())->updatePodcastContributor(
            $this->user->id,
            $this->podcast->id,
            $this->request->getPost('role')
        );

        return redirect()->route('contributor_list', [$this->podcast->id]);
    }

    public function remove()
    {
        if ($this->podcast->owner_id == $this->user->id) {
            return redirect()
                ->back()
                ->with('errors', [
                    lang('Contributor.messages.removeOwnerContributorError'),
                ]);
        }

        $podcastModel = new PodcastModel();
        if (
            !$podcastModel->removePodcastContributor(
                $this->user->id,
                $this->podcast->id
            )
        ) {
            return redirect()
                ->back()
                ->with('errors', $podcastModel->errors());
        }

        return redirect()
            ->back()
            ->with(
                'message',
                lang('Contributor.messages.removeContributorSuccess', [
                    'username' => $this->user->username,
                    'podcastTitle' => $this->podcast->title,
                ])
            );
    }
}
