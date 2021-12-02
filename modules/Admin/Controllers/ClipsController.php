<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use MediaClipper\VideoClip;

class ClipsController extends BaseController
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

    public function videoClips(): string
    {
        helper('form');

        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->episode->slug,
        ]);
        return view('episode/video_clips', $data);
    }

    public function generateVideoClip(): RedirectResponse
    {
        $rules = [
            'format' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // TODO: start and end

        helper('media');

        $clipper = new VideoClip(
            $this->episode,
            (float) $this->request->getPost('start_time'),
            (float) $this->request->getPost('end_time',),
            'landscape'
        );
        $clipper->generate();

        return redirect()->route('video-clips', [$this->podcast->id, $this->episode->id])->with(
            'message',
            lang('Settings.images.regenerationSuccess')
        );
    }
}
