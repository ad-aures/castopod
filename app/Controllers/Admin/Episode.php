<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use App\Models\SoundbiteModel;
use CodeIgniter\I18n\Time;

class Episode extends BaseController
{
    /**
     * @var \App\Entities\Podcast
     */
    protected $podcast;

    /**
     * @var \App\Entities\Episode|null
     */
    protected $episode;

    /**
     * @var \App\Entities\Soundbite|null
     */
    protected $soundbites;

    public function _remap($method, ...$params)
    {
        $this->podcast = (new PodcastModel())->getPodcastById($params[0]);

        if (count($params) > 1) {
            if (
                !($this->episode = (new EpisodeModel())
                    ->where([
                        'id' => $params[1],
                        'podcast_id' => $params[0],
                    ])
                    ->first())
            ) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            unset($params[1]);
            unset($params[0]);
        }

        return $this->$method(...$params);
    }

    public function list()
    {
        $episodes = (new EpisodeModel())
            ->where('podcast_id', $this->podcast->id)
            ->orderBy('created_at', 'desc');

        $data = [
            'podcast' => $this->podcast,
            'episodes' => $episodes->paginate(10),
            'pager' => $episodes->pager,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
        ]);
        return view('admin/episode/list', $data);
    }

    public function view()
    {
        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->episode->title,
        ]);
        return view('admin/episode/view', $data);
    }

    public function create()
    {
        helper(['form']);

        $data = [
            'podcast' => $this->podcast,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
        ]);
        return view('admin/episode/create', $data);
    }

    public function attemptCreate()
    {
        $rules = [
            'enclosure' => 'uploaded[enclosure]|ext_in[enclosure,mp3,m4a]',
            'image' =>
                'is_image[image]|ext_in[image,jpg,png]|min_dims[image,1400,1400]|is_image_squared[image]',
            'transcript' => 'ext_in[transcript,txt,html,srt,json]',
            'chapters' => 'ext_in[chapters,json]',
            'publication_date' => 'valid_date[Y-m-d H:i]|permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $publicationDate = $this->request->getPost('publication_date');
        $newEpisode = new \App\Entities\Episode([
            'podcast_id' => $this->podcast->id,
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'guid' => '',
            'enclosure' => $this->request->getFile('enclosure'),
            'description_markdown' => $this->request->getPost('description'),
            'image' => $this->request->getFile('image'),
            'transcript' => $this->request->getFile('transcript'),
            'chapters' => $this->request->getFile('chapters'),
            'parental_advisory' =>
                $this->request->getPost('parental_advisory') !== 'undefined'
                    ? $this->request->getPost('parental_advisory')
                    : null,
            'number' => $this->request->getPost('episode_number')
                ? $this->request->getPost('episode_number')
                : null,
            'season_number' => $this->request->getPost('season_number')
                ? $this->request->getPost('season_number')
                : null,
            'type' => $this->request->getPost('type'),
            'is_blocked' => $this->request->getPost('block') == 'yes',
            'created_by' => user(),
            'updated_by' => user(),
            'published_at' => $publicationDate
                ? Time::createFromFormat(
                    'Y-m-d H:i',
                    $publicationDate,
                    $this->request->getPost('client_timezone')
                )->setTimezone('UTC')
                : null,
        ]);

        $episodeModel = new EpisodeModel();

        if (!($newEpisodeId = $episodeModel->insert($newEpisode, true))) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        // update podcast's episode_description_footer_markdown if changed
        $podcastModel = new PodcastModel();

        if ($this->podcast->hasChanged('episode_description_footer_markdown')) {
            $this->podcast->episode_description_footer_markdown = $this->request->getPost(
                'description_footer'
            );

            if (!$podcastModel->update($this->podcast->id, $this->podcast)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $podcastModel->errors());
            }
        }

        return redirect()->route('episode-view', [
            $this->podcast->id,
            $newEpisodeId,
        ]);
    }

    public function edit()
    {
        helper(['form']);

        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->episode->title,
        ]);
        return view('admin/episode/edit', $data);
    }

    public function attemptEdit()
    {
        $rules = [
            'enclosure' =>
                'uploaded[enclosure]|ext_in[enclosure,mp3,m4a]|permit_empty',
            'image' =>
                'is_image[image]|ext_in[image,jpg,png]|min_dims[image,1400,1400]|is_image_squared[image]',
            'transcript' => 'ext_in[transcript,txt,html,srt,json]',
            'chapters' => 'ext_in[chapters,json]',
            'publication_date' => 'valid_date[Y-m-d H:i]|permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->episode->title = $this->request->getPost('title');
        $this->episode->slug = $this->request->getPost('slug');
        $this->episode->description_markdown = $this->request->getPost(
            'description'
        );
        $this->episode->parental_advisory =
            $this->request->getPost('parental_advisory') !== 'undefined'
                ? $this->request->getPost('parental_advisory')
                : null;
        $this->episode->number = $this->request->getPost('episode_number')
            ? $this->request->getPost('episode_number')
            : null;
        $this->episode->season_number = $this->request->getPost('season_number')
            ? $this->request->getPost('season_number')
            : null;
        $this->episode->type = $this->request->getPost('type');
        $this->episode->is_blocked = $this->request->getPost('block') == 'yes';

        $publicationDate = $this->request->getPost('publication_date');
        $this->episode->published_at = $publicationDate
            ? Time::createFromFormat(
                'Y-m-d H:i',
                $publicationDate,
                $this->request->getPost('client_timezone')
            )->setTimezone('UTC')
            : null;

        $this->episode->updated_by = user();

        $enclosure = $this->request->getFile('enclosure');
        if ($enclosure->isValid()) {
            $this->episode->enclosure = $enclosure;
        }
        $image = $this->request->getFile('image');
        if ($image) {
            $this->episode->image = $image;
        }
        $transcript = $this->request->getFile('transcript');
        if ($transcript->isValid()) {
            $this->episode->transcript = $transcript;
        }
        $chapters = $this->request->getFile('chapters');
        if ($chapters->isValid()) {
            $this->episode->chapters = $chapters;
        }

        $episodeModel = new EpisodeModel();

        if (!$episodeModel->update($this->episode->id, $this->episode)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        // update podcast's episode_description_footer_markdown if changed
        $this->podcast->episode_description_footer_markdown = $this->request->getPost(
            'description_footer'
        );

        if ($this->podcast->hasChanged('episode_description_footer_markdown')) {
            $podcastModel = new PodcastModel();
            if (!$podcastModel->update($this->podcast->id, $this->podcast)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $podcastModel->errors());
            }
        }

        return redirect()->route('episode-view', [
            $this->podcast->id,
            $this->episode->id,
        ]);
    }

    public function transcriptDelete()
    {
        unlink($this->episode->transcript);
        $this->episode->transcript_uri = null;

        $episodeModel = new EpisodeModel();

        if (!$episodeModel->update($this->episode->id, $this->episode)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        return redirect()->back();
    }

    public function chaptersDelete()
    {
        unlink($this->episode->chapters);
        $this->episode->chapters_uri = null;

        $episodeModel = new EpisodeModel();

        if (!$episodeModel->update($this->episode->id, $this->episode)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        return redirect()->back();
    }

    public function delete()
    {
        (new EpisodeModel())->delete($this->episode->id);

        return redirect()->route('episode-list', [$this->podcast->id]);
    }

    public function soundbitesEdit()
    {
        helper(['form']);

        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->episode->title,
        ]);
        return view('admin/episode/soundbites', $data);
    }

    public function soundbitesAttemptEdit()
    {
        $soundbites_array = $this->request->getPost('soundbites_array');
        $rules = [
            'soundbites_array.0.start_time' =>
                'permit_empty|required_with[soundbites_array.0.duration]|decimal|greater_than_equal_to[0]',
            'soundbites_array.0.duration' =>
                'permit_empty|required_with[soundbites_array.0.start_time]|decimal|greater_than_equal_to[0]',
        ];
        foreach ($soundbites_array as $soundbite_id => $soundbite) {
            $rules += [
                "soundbites_array.{$soundbite_id}.start_time" => 'required|decimal|greater_than_equal_to[0]',
                "soundbites_array.{$soundbite_id}.duration" => 'required|decimal|greater_than_equal_to[0]',
            ];
        }
        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        foreach ($soundbites_array as $soundbite_id => $soundbite) {
            if (
                !empty($soundbite['start_time']) &&
                !empty($soundbite['duration'])
            ) {
                $data = [
                    'podcast_id' => $this->podcast->id,
                    'episode_id' => $this->episode->id,
                    'start_time' => $soundbite['start_time'],
                    'duration' => $soundbite['duration'],
                    'label' => $soundbite['label'],
                    'updated_by' => user()->id,
                ];
                if ($soundbite_id == 0) {
                    $data += ['created_by' => user()->id];
                } else {
                    $data += ['id' => $soundbite_id];
                }
                $soundbiteModel = new SoundbiteModel();
                if (!$soundbiteModel->save($data)) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('errors', $soundbiteModel->errors());
                }
            }
        }
        return redirect()->route('soundbites-edit', [
            $this->podcast->id,
            $this->episode->id,
        ]);
    }

    public function soundbiteDelete($soundbiteId)
    {
        (new SoundbiteModel())->deleteSoundbite(
            $this->podcast->id,
            $this->episode->id,
            $soundbiteId
        );

        return redirect()->route('soundbites-edit', [
            $this->podcast->id,
            $this->episode->id,
        ]);
    }
}
