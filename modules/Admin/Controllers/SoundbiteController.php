<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Entities\Clip\Soundbite;
use App\Entities\Episode;
use App\Entities\Podcast;
use App\Models\ClipModel;
use App\Models\EpisodeModel;
use App\Models\MediaModel;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

class SoundbiteController extends BaseController
{
    protected Podcast $podcast;

    protected Episode $episode;

    public function _remap(string $method, string ...$params): mixed
    {
        if (
            ($podcast = (new PodcastModel())->getPodcastById((int) $params[0])) === null
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->podcast = $podcast;

        if (count($params) > 1) {
            if (
                ! ($episode = (new EpisodeModel())
                    ->where([
                        'id' => $params[1],
                        'podcast_id' => $params[0],
                    ])
                    ->first())
            ) {
                throw PageNotFoundException::forPageNotFound();
            }

            $this->episode = $episode;

            unset($params[1]);
            unset($params[0]);
        }

        return $this->{$method}(...$params);
    }

    public function list(): string
    {
        $soundbitesBuilder = (new ClipModel('audio'))
            ->where([
                'podcast_id' => $this->podcast->id,
                'episode_id' => $this->episode->id,
                'type' => 'audio',
            ])
            ->orderBy('created_at', 'desc');

        $soundbites = $soundbitesBuilder->paginate(10);

        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
            'soundbites' => $soundbites,
            'pager' => $soundbitesBuilder->pager,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
            1 => $this->episode->title,
        ]);
        return view('episode/soundbites_list', $data);
    }

    public function create(): string
    {
        helper(['form']);

        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
            1 => $this->episode->title,
        ]);
        return view('episode/soundbites_new', $data);
    }

    public function attemptCreate(): RedirectResponse
    {
        $rules = [
            'title' => 'required',
            'start_time' => 'required|greater_than_equal_to[0]',
            'duration' => 'required|greater_than[0]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $newSoundbite = new Soundbite([
            'title' => $this->request->getPost('title'),
            'start_time' => (float) $this->request->getPost('start_time'),
            'duration' => (float) $this->request->getPost('duration',),
            'type' => 'audio',
            'status' => '',
            'podcast_id' => $this->podcast->id,
            'episode_id' => $this->episode->id,
            'created_by' => user_id(),
            'updated_by' => user_id(),
        ]);

        $clipModel = new ClipModel('audio');
        if (! $clipModel->save($newSoundbite)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $clipModel->errors());
        }

        return redirect()->route('soundbites-list', [$this->podcast->id, $this->episode->id])->with(
            'message',
            lang('Soundbite.messages.createSuccess')
        );
    }

    public function delete(string $soundbiteId): RedirectResponse
    {
        $soundbite = (new ClipModel())->getSoundbiteById((int) $soundbiteId);

        if (! $soundbite instanceof Soundbite) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ($soundbite->media === null) {
            // delete Clip directly
            (new ClipModel())->deleteSoundbite($this->podcast->id, $this->episode->id, $soundbite->id);
        } else {
            (new ClipModel())->clearSoundbiteCache($this->podcast->id, $this->episode->id, $soundbite->id);

            $mediaModel = new MediaModel();
            // delete the soundbite file, the clip will be deleted on cascade
            if (! $mediaModel->deleteMedia($soundbite->media)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $mediaModel->errors());
            }
        }

        return redirect()->route('soundbites-list', [$this->podcast->id, $this->episode->id])->with(
            'message',
            lang('Soundbite.messages.deleteSuccess')
        );
    }
}
