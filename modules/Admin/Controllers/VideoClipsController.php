<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Entities\Clip\VideoClip;
use App\Entities\Episode;
use App\Entities\Podcast;
use App\Models\ClipModel;
use App\Models\EpisodeModel;
use App\Models\MediaModel;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

class VideoClipsController extends BaseController
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
        $videoClipsBuilder = (new ClipModel('video'))
            ->where([
                'podcast_id' => $this->podcast->id,
                'episode_id' => $this->episode->id,
                'type' => 'video',
            ])
            ->orderBy('created_at', 'desc');

        $clips = $videoClipsBuilder->paginate(10);

        $videoClips = [];
        foreach ($clips as $clip) {
            $videoClips[] = new VideoClip($clip->toArray());
        }

        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
            'videoClips' => $videoClips,
            'pager' => $videoClipsBuilder->pager,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
            1 => $this->episode->title,
        ]);
        return view('episode/video_clips_list', $data);
    }

    public function view($videoClipId): string
    {
        $videoClip = (new ClipModel())->getVideoClipById((int) $videoClipId);

        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
            'videoClip' => $videoClip,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
            1 => $this->episode->title,
            2 => $videoClip->title,
        ]);
        return view('episode/video_clip', $data);
    }

    public function create(): string
    {
        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
            1 => $this->episode->title,
        ]);

        // First, check that requirements to create a video clip are met
        $ffmpeg = shell_exec('which ffmpeg');
        $checks = [
            'ffmpeg' => $ffmpeg !== null,
            'gd' => extension_loaded('gd'),
            'freetype' => extension_loaded('gd') && gd_info()['FreeType Support'],
            'transcript' => $this->episode->transcript !== null,
        ];

        if (in_array(false, $checks, true)) {
            $data['checks'] = $checks;

            return view('episode/video_clips_requirements', $data);
        }

        helper('form');
        return view('episode/video_clips_new', $data);
    }

    public function attemptCreate(): RedirectResponse
    {
        $rules = [
            'title' => 'required',
            'start_time' => 'required|greater_than_equal_to[0]',
            'duration' => 'required|greater_than[0]',
            'format' => 'required|in_list[' . implode(',', array_keys(config('MediaClipper')->formats)) . ']',
            'theme' => 'required|in_list[' . implode(',', array_keys(config('Colors')->themes)) . ']',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $themeName = $this->request->getPost('theme');
        $themeColors = config('MediaClipper')
            ->themes[$themeName];
        $theme = [
            'name' => $themeName,
            'preview' => $themeColors['preview'],
        ];

        $videoClip = new VideoClip([
            'title' => $this->request->getPost('title'),
            'start_time' => (float) $this->request->getPost('start_time'),
            'duration' => (float) $this->request->getPost('duration'),
            'theme' => $theme,
            'format' => $this->request->getPost('format'),
            'type' => 'video',
            'status' => 'queued',
            'podcast_id' => $this->podcast->id,
            'episode_id' => $this->episode->id,
            'created_by' => user_id(),
            'updated_by' => user_id(),
        ]);

        // Check if video clip exists before inserting a new line
        if ((new ClipModel())->doesVideoClipExist($videoClip)) {
            // video clip already exists
            return redirect()
                ->back()
                ->withInput()
                ->with('error', lang('VideoClip.messages.alreadyExistingError'));
        }

        (new ClipModel())->insert($videoClip);

        return redirect()->route('video-clips-list', [$this->podcast->id, $this->episode->id])->with(
            'message',
            lang('VideoClip.messages.addToQueueSuccess')
        );
    }

    public function retry(string $videoClipId): RedirectResponse
    {
        $videoClip = (new ClipModel())->getVideoClipById((int) $videoClipId);

        if (! $videoClip instanceof VideoClip) {
            throw PageNotFoundException::forPageNotFound();
        }

        (new ClipModel())->update($videoClip->id, [
            'status' => 'queued',
            'job_started_at' => null,
            'job_ended_at' => null,
        ]);

        return redirect()->back();
    }

    public function delete(string $videoClipId): RedirectResponse
    {
        $videoClip = (new ClipModel())->getVideoClipById((int) $videoClipId);

        if (! $videoClip instanceof VideoClip) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ($videoClip->media === null) {
            // delete Clip directly
            (new ClipModel())->deleteVideoClip($this->podcast->id, $this->episode->id, $videoClip->id);
        } else {
            (new ClipModel())->clearVideoClipCache($videoClip->id);

            $mediaModel = new MediaModel();
            // delete the videoClip file, the clip will be deleted on cascade
            if (! $mediaModel->deleteMedia($videoClip->media)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $mediaModel->errors());
            }
        }

        return redirect()->back();
    }
}
