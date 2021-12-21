<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Entities\Clip;
use App\Entities\Clip\VideoClip;
use App\Entities\Episode;
use App\Entities\Podcast;
use App\Models\ClipModel;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use MediaClipper\VideoClipper;

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
        $videoClips = (new ClipModel('video'))
            ->where([
                'podcast_id' => $this->podcast->id,
                'episode_id' => $this->episode->id,
                'type' => 'video',
            ])
            ->orderBy('created_at', 'desc');

        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
            'videoClips' => $videoClips->paginate(10),
            'pager' => $videoClips->pager,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->episode->title,
        ]);
        return view('episode/video_clips_list', $data);
    }

    public function generate(): string
    {
        helper('form');

        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->episode->title,
        ]);
        return view('episode/video_clips_new', $data);
    }

    public function attemptGenerate(): RedirectResponse
    {
        // TODO: add end_time greater than start_time, with minimum ?
        $rules = [
            'start_time' => 'required|numeric',
            'end_time' => 'required|numeric|differs[start_time]',
            'format' => 'required|in_list[' . implode(',', array_keys(config('MediaClipper')->formats)) . ']',
            'theme' => 'required|in_list[' . implode(',', array_keys(config('Colors')->themes)) . ']',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $videoClip = new VideoClip([
            'label' => 'NEW CLIP',
            'start_time' => (float) $this->request->getPost('start_time'),
            'end_time' => (float) $this->request->getPost('end_time',),
            'type' => 'video',
            'status' => 'queued',
            'podcast_id' => $this->podcast->id,
            'episode_id' => $this->episode->id,
            'created_by' => user_id(),
            'updated_by' => user_id(),
        ]);

        (new ClipModel())->insert($videoClip);

        return redirect()->route('video-clips-generate', [$this->podcast->id, $this->episode->id])->with(
            'message',
            lang('Settings.images.regenerationSuccess')
        );
    }

    public function scheduleClips(): void
    {
        // get all clips that haven't been generated
        $scheduledClips = (new ClipModel())->getScheduledVideoClips();

        foreach ($scheduledClips as $scheduledClip) {
            $scheduledClip->status = 'pending';
        }

        (new ClipModel())->updateBatch($scheduledClips);

        // Loop through clips to generate them
        foreach ($scheduledClips as $scheduledClip) {
            // set clip to pending
            (new ClipModel())
                ->update($scheduledClip->id, [
                    'status' => 'running',
                ]);
            $clipper = new VideoClipper(
                $scheduledClip->episode,
                $scheduledClip->start_time,
                $scheduledClip->end_time,
                $scheduledClip->format,
                $scheduledClip->theme,
            );
            $output = $clipper->generate();
            $scheduledClip->setMedia($clipper->videoClipOutput);

            (new ClipModel())->update($scheduledClip->id, [
                'status' => 'passed',
                'logs' => $output,
            ]);
        }
    }
}
