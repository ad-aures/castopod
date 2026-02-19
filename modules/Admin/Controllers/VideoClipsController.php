<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Entities\Clip\BaseClip;
use App\Entities\Clip\VideoClip;
use App\Entities\Episode;
use App\Entities\Podcast;
use App\Models\ClipModel;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use Modules\Media\Entities\Transcript;
use Modules\Media\Models\MediaModel;

class VideoClipsController extends BaseController
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
        $videoClipsBuilder = new ClipModel('video')
            ->where([
                'podcast_id' => $episode->podcast_id,
                'episode_id' => $episode->id,
                'type'       => 'video',
            ])
            ->orderBy('created_at', 'desc');

        /** @var BaseClip[] $clips */
        $clips = $videoClipsBuilder->paginate(10);

        $videoClips = [];
        foreach ($clips as $clip) {
            $videoClips[] = new VideoClip($clip->toArray());
        }

        $data = [
            'podcast'    => $episode->podcast,
            'episode'    => $episode,
            'videoClips' => $videoClips,
            'pager'      => $videoClipsBuilder->pager,
        ];

        $this->setHtmlHead(lang('VideoClip.list.title'));
        replace_breadcrumb_params([
            0 => $episode->podcast->at_handle,
            1 => $episode->title,
        ]);
        return view('episode/video_clips_list', $data);
    }

    public function view(Episode $episode, string $videoClipId): string
    {
        $videoClip = new ClipModel()
            ->getVideoClipById((int) $videoClipId);

        $data = [
            'podcast'   => $episode->podcast,
            'episode'   => $episode,
            'videoClip' => $videoClip,
        ];

        $this->setHtmlHead(lang('VideoClip.title', [
            'videoClipLabel' => esc($videoClip->title),
        ]));
        replace_breadcrumb_params([
            0 => $episode->podcast->at_handle,
            1 => $episode->title,
            2 => $videoClip->title,
        ]);
        return view('episode/video_clip', $data);
    }

    public function createView(Episode $episode): string
    {
        $data = [
            'podcast' => $episode->podcast,
            'episode' => $episode,
        ];

        replace_breadcrumb_params([
            0 => $episode->podcast->at_handle,
            1 => $episode->title,
        ]);

        // First, check that requirements to create a video clip are met
        $ffmpeg = shell_exec('which ffmpeg');
        $checks = [
            'ffmpeg'     => $ffmpeg !== null,
            'gd'         => extension_loaded('gd'),
            'freetype'   => extension_loaded('gd') && gd_info()['FreeType Support'],
            'transcript' => $episode->transcript instanceof Transcript,
        ];

        $this->setHtmlHead(lang('VideoClip.form.title'));

        if (array_any($checks, fn (bool $value): bool => ! $value)) {
            $data['checks'] = $checks;
            return view('episode/video_clips_requirements', $data);
        }

        helper('form');
        return view('episode/video_clips_new', $data);
    }

    public function createAction(Episode $episode): RedirectResponse
    {
        $rules = [
            'title'      => 'required',
            'start_time' => 'required|greater_than_equal_to[0]',
            'duration'   => 'required|greater_than[0]',
            'format'     => 'required|in_list[' . implode(',', array_keys(config('MediaClipper')->formats)) . ']',
            'theme'      => 'required|in_list[' . implode(',', array_keys(config('Colors')->themes)) . ']',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        $themeName = $validData['theme'];
        $themeColors = config('MediaClipper')
            ->themes[$themeName];
        $theme = [
            'name'    => $themeName,
            'preview' => $themeColors['preview'],
        ];

        $videoClip = new VideoClip([
            'title'      => $validData['title'],
            'start_time' => (float) $validData['start_time'],
            'duration'   => (float) $validData['duration'],
            'theme'      => $theme,
            'format'     => $validData['format'],
            'type'       => 'video',
            'status'     => 'queued',
            'podcast_id' => $episode->podcast_id,
            'episode_id' => $episode->id,
            'created_by' => user_id(),
            'updated_by' => user_id(),
        ]);

        // Check if video clip exists before inserting a new line
        if (new ClipModel()->doesVideoClipExist($videoClip)) {
            // video clip already exists
            return redirect()
                ->back()
                ->withInput()
                ->with('error', lang('VideoClip.messages.alreadyExistingError'));
        }

        new ClipModel()
            ->insert($videoClip);

        return redirect()->route('video-clips-list', [$episode->podcast_id, $episode->id])->with(
            'message',
            lang('VideoClip.messages.addToQueueSuccess'),
        );
    }

    public function retryAction(Episode $episode, string $videoClipId): RedirectResponse
    {
        $videoClip = new ClipModel()
            ->getVideoClipById((int) $videoClipId);

        if (! $videoClip instanceof VideoClip) {
            throw PageNotFoundException::forPageNotFound();
        }

        new ClipModel()
            ->update($videoClip->id, [
                'status'         => 'queued',
                'job_started_at' => null,
                'job_ended_at'   => null,
            ]);

        return redirect()->back();
    }

    public function deleteAction(Episode $episode, string $videoClipId): RedirectResponse
    {
        $videoClip = new ClipModel()
            ->getVideoClipById((int) $videoClipId);

        if (! $videoClip instanceof VideoClip) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ($videoClip->media === null) {
            // delete Clip directly
            new ClipModel()
                ->deleteVideoClip($videoClip->id);
        } else {
            new ClipModel()
                ->clearVideoClipCache($videoClip->id);

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
