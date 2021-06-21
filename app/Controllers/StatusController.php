<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use ActivityPub\Controllers\StatusController as ActivityPubStatusController;
use ActivityPub\Entities\Status as ActivityPubStatus;
use Analytics\AnalyticsTrait;
use App\Entities\Actor;
use App\Entities\Podcast;
use App\Entities\Status as CastopodStatus;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use App\Models\StatusModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\URI;
use CodeIgniter\I18n\Time;

class StatusController extends ActivityPubStatusController
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
        if (
            ($podcast = (new PodcastModel())->getPodcastByName($params[0],)) === null
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->podcast = $podcast;
        $this->actor = $this->podcast->actor;

        if (
            count($params) > 1 &&
            ($status = (new StatusModel())->getStatusById($params[1])) !== null
        ) {
            $this->status = $status;

            unset($params[0]);
            unset($params[1]);
        }

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
                "status#{$this->status->id}",
                service('request')
                    ->getLocale(),
                can_user_interact() ? '_authenticated' : null,
            ]),
        );

        if (! ($cachedView = cache($cacheName))) {
            $data = [
                'podcast' => $this->podcast,
                'actor' => $this->actor,
                'status' => $this->status,
            ];

            // if user is logged in then send to the authenticated activity view
            if (can_user_interact()) {
                helper('form');
                return view('podcast/status_authenticated', $data);
            }
            return view('podcast/status', $data, [
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

        $newStatus = new CastopodStatus([
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
            $newStatus->episode_id = $episode->id;
        }

        $newStatus->message = $message;

        $statusModel = new StatusModel();
        if (
            ! $statusModel
                ->addStatus($newStatus, ! (bool) $newStatus->episode_id, true)
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $statusModel->errors());
        }

        // Status has been successfully created
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

        $newStatus = new ActivityPubStatus([
            'actor_id' => interact_as_actor_id(),
            'in_reply_to_id' => $this->status->id,
            'message' => $this->request->getPost('message'),
            'published_at' => Time::now(),
            'created_by' => user_id(),
        ]);

        $statusModel = new StatusModel();
        if (! $statusModel->addReply($newStatus)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $statusModel->errors());
        }

        // Reply status without preview card has been successfully created
        return redirect()->back();
    }

    public function attemptFavourite(): RedirectResponse
    {
        model('FavouriteModel')->toggleFavourite(interact_as_actor(), $this->status);

        return redirect()->back();
    }

    public function attemptReblog(): RedirectResponse
    {
        (new StatusModel())->toggleReblog(interact_as_actor(), $this->status);

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
        return match ($action) {
            'favourite' => $this->attemptFavourite(),
            'reblog' => $this->attemptReblog(),
            'reply' => $this->attemptReply(),
            default => redirect()
                ->back()
                ->withInput()
                ->with('errors', 'error'),
        };
    }

    public function remoteAction(string $action): string
    {
        // Prevent analytics hit when authenticated
        if (! can_user_interact()) {
            $this->registerPodcastWebpageHit($this->podcast->id);
        }

        $cacheName = implode(
            '_',
            array_filter(['page', "status#{$this->status->id}", "remote_{$action}", service('request') ->getLocale()]),
        );

        if (! ($cachedView = cache($cacheName))) {
            $data = [
                'podcast' => $this->podcast,
                'actor' => $this->actor,
                'status' => $this->status,
                'action' => $action,
            ];

            helper('form');

            return view('podcast/status_remote_action', $data, [
                'cache' => DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return (string) $cachedView;
    }
}
