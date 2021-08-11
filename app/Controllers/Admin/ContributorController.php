<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Authorization\GroupModel;
use App\Entities\Podcast;
use App\Entities\User;
use App\Models\PodcastModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use Exception;

class ContributorController extends BaseController
{
    protected Podcast $podcast;

    protected ?User $user;

    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (($podcast = (new PodcastModel())->getPodcastById((int) $params[0])) === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->podcast = $podcast;

        if (count($params) <= 1) {
            return $this->{$method}();
        }

        if (($this->user = (new UserModel())->getPodcastContributor((int) $params[1], (int) $params[0])) !== null) {
            return $this->{$method}();
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function list(): string
    {
        $data = [
            'podcast' => $this->podcast,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
        ]);
        return view('admin/contributor/list', $data);
    }

    public function view(): string
    {
        $data = [
            'contributor' => (new UserModel())->getPodcastContributor($this->user->id, $this->podcast->id),
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->user->username,
        ]);
        return view('admin/contributor/view', $data);
    }

    public function add(): string
    {
        helper('form');

        $users = (new UserModel())->findAll();
        $userOptions = array_reduce(
            $users,
            function ($result, $user) {
                $result[$user->id] = $user->username;
                return $result;
            },
            [],
        );

        $roles = (new GroupModel())->getContributorRoles();
        $roleOptions = array_reduce(
            $roles,
            function ($result, $role) {
                $result[$role->id] = lang('Contributor.roles.' . $role->name);
                return $result;
            },
            [],
        );

        $data = [
            'podcast' => $this->podcast,
            'userOptions' => $userOptions,
            'roleOptions' => $roleOptions,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
        ]);
        return view('admin/contributor/add', $data);
    }

    public function attemptAdd(): RedirectResponse
    {
        try {
            (new PodcastModel())->addPodcastContributor(
                (int) $this->request->getPost('user'),
                $this->podcast->id,
                (int) $this->request->getPost('role'),
            );
        } catch (Exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [lang('Contributor.messages.alreadyAddedError')]);
        }

        return redirect()->route('contributor-list', [$this->podcast->id]);
    }

    public function edit(): string
    {
        helper('form');

        $roles = (new GroupModel())->getContributorRoles();
        $roleOptions = array_reduce(
            $roles,
            function ($result, $role) {
                $result[$role->id] = lang('Contributor.roles.' . $role->name);
                return $result;
            },
            [],
        );

        $data = [
            'podcast' => $this->podcast,
            'user' => $this->user,
            'contributorGroupId' => (new PodcastModel())->getContributorGroupId(
                $this->user->id,
                $this->podcast->id,
            ),
            'roleOptions' => $roleOptions,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->user->username,
        ]);
        return view('admin/contributor/edit', $data);
    }

    public function attemptEdit(): RedirectResponse
    {
        (new PodcastModel())->updatePodcastContributor(
            $this->user->id,
            $this->podcast->id,
            (int) $this->request->getPost('role'),
        );

        return redirect()->route('contributor-list', [$this->podcast->id]);
    }

    public function remove(): RedirectResponse
    {
        if ($this->podcast->created_by === $this->user->id) {
            return redirect()
                ->back()
                ->with('errors', [lang('Contributor.messages.removeOwnerContributorError')]);
        }

        $podcastModel = new PodcastModel();
        if (
            ! $podcastModel->removePodcastContributor($this->user->id, $this->podcast->id)
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
                ]),
            );
    }
}
