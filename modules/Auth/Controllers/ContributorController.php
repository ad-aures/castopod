<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Auth\Controllers;

use App\Entities\Podcast;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Entities\User;
use Modules\Admin\Controllers\BaseController;
use Modules\Auth\Models\UserModel;

class ContributorController extends BaseController
{
    protected Podcast $podcast;

    protected ?User $contributor = null;

    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (! ($podcast = (new PodcastModel())->getPodcastById((int) $params[0])) instanceof Podcast) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->podcast = $podcast;

        if (count($params) <= 1) {
            return $this->{$method}();
        }

        if (($this->contributor = (new UserModel())->getPodcastContributor(
            (int) $params[1],
            (int) $params[0]
        )) instanceof User) {
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
            0 => $this->podcast->at_handle,
        ]);
        return view('contributor/list', $data);
    }

    public function view(): string
    {
        $data = [
            'podcast'     => $this->podcast,
            'contributor' => (new UserModel())->getPodcastContributor($this->contributor->id, $this->podcast->id),
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
            1 => $this->contributor->username,
        ]);
        return view('contributor/view', $data);
    }

    public function create(): string
    {
        helper('form');

        $users = (new UserModel())->findAll();
        $contributorOptions = array_reduce(
            $users,
            static function (array $result, $user): array {
                $result[$user->id] = $user->username;
                return $result;
            },
            [],
        );

        $roles = setting('AuthGroups.podcastBaseGroups');
        $roleOptions = [];
        array_walk(
            $roles,
            static function (string $role, $key) use (&$roleOptions): array {
                $roleOptions[$role] = lang('Auth.podcast_groups.' . $role . '.title');
                return $roleOptions;
            },
            [],
        );

        $data = [
            'podcast'            => $this->podcast,
            'contributorOptions' => $contributorOptions,
            'roleOptions'        => $roleOptions,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);
        return view('contributor/create', $data);
    }

    public function attemptCreate(): RedirectResponse
    {
        $user = (new UserModel())->find((int) $this->request->getPost('user'));

        if (get_podcast_group($user, $this->podcast->id)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [lang('Contributor.messages.alreadyAddedError')]);
        }

        add_podcast_group($user, $this->podcast->id, $this->request->getPost('role'));

        return redirect()->route('contributor-list', [$this->podcast->id]);
    }

    public function edit(): string|RedirectResponse
    {
        helper('form');

        $roles = setting('AuthGroups.podcastBaseGroups');
        $roleOptions = [];
        array_walk(
            $roles,
            static function (string $role) use (&$roleOptions): array {
                $roleOptions[$role] = lang('Auth.podcast_groups.' . $role . '.title');
                return $roleOptions;
            },
            [],
        );

        $contributorGroup = get_podcast_group($this->contributor, $this->podcast->id);

        if ($contributorGroup === null) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [lang('Contributor.messages.notAddedError')]);
        }

        $data = [
            'podcast'          => $this->podcast,
            'contributor'      => $this->contributor,
            'contributorGroup' => $contributorGroup,
            'roleOptions'      => $roleOptions,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
            1 => $this->contributor->username,
        ]);
        return view('contributor/edit', $data);
    }

    public function attemptEdit(): RedirectResponse
    {
        // forbid updating a podcast owner
        if ($this->podcast->created_by === $this->contributor->id) {
            return redirect()
                ->back()
                ->with('errors', [lang('Contributor.messages.editOwnerError')]);
        }

        $group = $this->request->getPost('role');

        set_podcast_group($this->contributor, $this->podcast->id, $group);

        cache()
            ->delete("podcast#{$this->podcast->id}_contributors");

        return redirect()->route('contributor-list', [$this->podcast->id])->with(
            'message',
            lang('Contributor.messages.editSuccess')
        );
    }

    public function remove(): string
    {
        helper('form');

        $data = [
            'podcast'     => $this->podcast,
            'contributor' => $this->contributor,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
            1 => $this->contributor->username,
        ]);
        return view('contributor/delete', $data);
    }

    public function attemptRemove(): RedirectResponse
    {
        if ($this->podcast->created_by === $this->contributor->id) {
            return redirect()
                ->back()
                ->with('errors', [lang('Contributor.messages.removeOwnerError')]);
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

        cache()
            ->delete("podcast#{$this->podcast->id}_contributors");

        // remove contributor from podcast group
        $this->contributor->removeGroup(get_podcast_group($this->contributor, $this->podcast->id, false));

        return redirect()
            ->route('contributor-list', [$this->podcast->id])
            ->with(
                'message',
                lang('Contributor.messages.removeSuccess', [
                    'username'     => $this->contributor->username,
                    'podcastTitle' => $this->podcast->title,
                ]),
            );
    }
}
