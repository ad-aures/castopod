<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use ActivityPub\Controllers\NoteController as ActivityPubNoteController;
use ActivityPub\Entities\Note as ActivityPubNote;
use Analytics\AnalyticsTrait;
use App\Entities\Actor;
use App\Entities\Note as CastopodNote;
use App\Entities\Podcast;
use App\Models\EpisodeModel;
use App\Models\NoteModel;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\URI;
use CodeIgniter\I18n\Time;

class NoteController extends ActivityPubNoteController
{
    use AnalyticsTrait;

    protected Podcast $podcast;

    protected Actor $actor;

    /**
     * @var string[]
     */
    protected $helpers = ['auth', 'activitypub', 'svg', 'components', 'misc'];

    public function _remap(string $method, string ...$params): mixed
    {
        if (count($params) < 2) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (
            ($this->podcast = (new PodcastModel())->getPodcastByName($params[0])) === null
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->actor = $this->podcast->actor;

        if (
            ($note = (new NoteModel())->getNoteById($params[1])) === null
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->note = $note;

        unset($params[0]);
        unset($params[1]);

        return $this->{$method}(...$params);
    }

    public function view(): string
    {
        // Prevent analytics hit when authenticated
        if (! can_user_interact()) {
            $this->registerPodcastWebpageHit($this->podcast->id);
        }

        $cacheName = implode(
            '_',
            array_filter([
                'page',
                "note#{$this->note->id}",
                service('request')
                    ->getLocale(),
                can_user_interact() ? '_authenticated' : null,
            ]),
        );

        if (! ($cachedView = cache($cacheName))) {
            $data = [
                'podcast' => $this->podcast,
                'actor' => $this->actor,
                'note' => $this->note,
            ];

            // if user is logged in then send to the authenticated activity view
            if (can_user_interact()) {
                helper('form');
                return view('podcast/note_authenticated', $data);
            }
            return view('podcast/note', $data, [
                'cache' => DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $cachedView;
    }

    public function attemptCreate(): RedirectResponse
    {
        $rules = [
            'message' => 'required|max_length[500]',
            'episode_url' => 'valid_url|permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $message = $this->request->getPost('message');

        $newNote = new CastopodNote([
            'actor_id' => interact_as_actor_id(),
            'published_at' => Time::now(),
            'created_by' => user_id(),
        ]);

        // get episode if episodeUrl has been set
        $episodeUri = $this->request->getPost('episode_url');
        if (
            $episodeUri &&
            ($params = extract_params_from_episode_uri(new URI($episodeUri))) &&
            ($episode = (new EpisodeModel())->getEpisodeBySlug($params['podcastName'], $params['episodeSlug']))
        ) {
            $newNote->episode_id = $episode->id;
        }

        $newNote->message = $message;

        $noteModel = new NoteModel();
        if (
            ! $noteModel
                ->addNote($newNote, ! (bool) $newNote->episode_id, true)
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $noteModel->errors());
        }

        // Note has been successfully created
        return redirect()->back();
    }

    public function attemptReply(): RedirectResponse
    {
        $rules = [
            'message' => 'required|max_length[500]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $newNote = new ActivityPubNote([
            'actor_id' => interact_as_actor_id(),
            'in_reply_to_id' => $this->note->id,
            'message' => $this->request->getPost('message'),
            'published_at' => Time::now(),
            'created_by' => user_id(),
        ]);

        $noteModel = new NoteModel();
        if (! $noteModel->addReply($newNote)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $noteModel->errors());
        }

        // Reply note without preview card has been successfully created
        return redirect()->back();
    }

    public function attemptFavourite(): RedirectResponse
    {
        model('FavouriteModel')->toggleFavourite(interact_as_actor(), $this->note);

        return redirect()->back();
    }

    public function attemptReblog(): RedirectResponse
    {
        (new NoteModel())->toggleReblog(interact_as_actor(), $this->note);

        return redirect()->back();
    }

    public function attemptAction(): RedirectResponse
    {
        $rules = [
            'action' => 'required|in_list[favourite,reblog,reply]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $action = $this->request->getPost('action');
        /** @phpstan-ignore-next-line */
        switch ($action) {
            case 'favourite':
                return $this->attemptFavourite();
            case 'reblog':
                return $this->attemptReblog();
            case 'reply':
                return $this->attemptReply();
            default:
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', 'error');
        }
    }

    public function remoteAction(string $action): string
    {
        // Prevent analytics hit when authenticated
        if (! can_user_interact()) {
            $this->registerPodcastWebpageHit($this->podcast->id);
        }

        $cacheName = implode(
            '_',
            array_filter(['page', "note#{$this->note->id}", "remote_{$action}", service('request') ->getLocale()]),
        );

        if (! ($cachedView = cache($cacheName))) {
            $data = [
                'podcast' => $this->podcast,
                'actor' => $this->actor,
                'note' => $this->note,
                'action' => $action,
            ];

            helper('form');

            return view('podcast/note_remote_action', $data, [
                'cache' => DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return (string) $cachedView;
    }
}
