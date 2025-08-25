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
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use Modules\Media\Models\MediaModel;

class SoundbiteController extends BaseController
{
    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (count($params) === 1) {
            if (! ($podcast = new PodcastModel()->getPodcastById((int) $params[0])) instanceof Podcast) {
                throw PageNotFoundException::forPageNotFound();
            }

            return $this->{$method}($podcast);
        }

        if (
            ! ($episode = new EpisodeModel()->getEpisodeById((int) $params[1])) instanceof Episode
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        unset($params[0]);
        unset($params[1]);

        return $this->{$method}($episode, ...$params);
    }

    public function list(Episode $episode): string
    {
        $soundbitesBuilder = new ClipModel('audio')
            ->where([
                'podcast_id' => $episode->podcast_id,
                'episode_id' => $episode->id,
                'type'       => 'audio',
            ])
            ->orderBy('created_at', 'desc');

        $soundbites = $soundbitesBuilder->paginate(10);

        $data = [
            'podcast'    => $episode->podcast,
            'episode'    => $episode,
            'soundbites' => $soundbites,
            'pager'      => $soundbitesBuilder->pager,
        ];

        $this->setHtmlHead(lang('Soundbite.list.title'));
        replace_breadcrumb_params([
            0 => $episode->podcast->at_handle,
            1 => $episode->title,
        ]);
        return view('episode/soundbites_list', $data);
    }

    public function createView(Episode $episode): string
    {
        helper(['form']);

        $data = [
            'podcast' => $episode->podcast,
            'episode' => $episode,
        ];

        $this->setHtmlHead(lang('Soundbite.form.title'));
        replace_breadcrumb_params([
            0 => $episode->podcast->at_handle,
            1 => $episode->title,
        ]);
        return view('episode/soundbites_new', $data);
    }

    public function createAction(Episode $episode): RedirectResponse
    {
        $rules = [
            'title'      => 'required',
            'start_time' => 'required|greater_than_equal_to[0]',
            'duration'   => 'required|greater_than[0]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        $newSoundbite = new Soundbite([
            'title'      => $validData['title'],
            'start_time' => (float) $validData['start_time'],
            'duration'   => (float) $validData['duration'],
            'type'       => 'audio',
            'status'     => '',
            'podcast_id' => $episode->podcast_id,
            'episode_id' => $episode->id,
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

        return redirect()->route('soundbites-list', [$episode->podcast_id, $episode->id])->with(
            'message',
            lang('Soundbite.messages.createSuccess'),
        );
    }

    public function deleteAction(Episode $episode, string $soundbiteId): RedirectResponse
    {
        $soundbite = new ClipModel()
            ->getSoundbiteById((int) $soundbiteId);

        if (! $soundbite instanceof Soundbite) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ($soundbite->media === null) {
            // delete Clip directly
            new ClipModel()
                ->deleteSoundbite($episode->podcast_id, $episode->id, $soundbite->id);
        } else {
            new ClipModel()
                ->clearSoundbiteCache($episode->podcast_id, $episode->id, $soundbite->id);

            $mediaModel = new MediaModel();
            // delete the soundbite file, the clip will be deleted on cascade
            if (! $mediaModel->deleteMedia($soundbite->media)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $mediaModel->errors());
            }
        }

        return redirect()->route('soundbites-list', [$episode->podcast_id, $episode->id])->with(
            'message',
            lang('Soundbite.messages.deleteSuccess'),
        );
    }
}
