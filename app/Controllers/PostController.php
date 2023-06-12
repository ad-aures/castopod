<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Entities\Actor;
use App\Entities\Podcast;
use App\Entities\Post as CastopodPost;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use App\Models\PostModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\URI;
use CodeIgniter\I18n\Time;
use Modules\Analytics\AnalyticsTrait;
use Modules\Fediverse\Controllers\PostController as FediversePostController;
use Modules\Fediverse\Models\FavouriteModel;

class PostController extends FediversePostController
{
    use AnalyticsTrait;

    protected Podcast $podcast;

    protected Actor $actor;

    /**
     * @var CastopodPost
     */
    protected $post;

    /**
     * @var string[]
     */
    protected $helpers = ['auth', 'fediverse', 'svg', 'components', 'misc', 'seo', 'premium_podcasts'];

    public function _remap(string $method, string ...$params): mixed
    {
        if (
            ! ($podcast = (new PodcastModel())->getPodcastByHandle($params[0])) instanceof Podcast
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->podcast = $podcast;
        $this->actor = $this->podcast->actor;

        if (
            count($params) > 1 &&
            ($post = (new PostModel())->getPostById($params[1])) instanceof CastopodPost
        ) {
            $this->post = $post;

            unset($params[0]);
            unset($params[1]);
        }

        return $this->{$method}(...$params);
    }

    public function view(): string
    {
        // Prevent analytics hit when authenticated
        if (! auth()->loggedIn()) {
            $this->registerPodcastWebpageHit($this->podcast->id);
        }

        if (! $this->post instanceof CastopodPost) {
            throw PageNotFoundException::forPageNotFound();
        }

        $cacheName = implode(
            '_',
            array_filter([
                'page',
                "post#{$this->post->id}",
                service('request')
                    ->getLocale(),
                auth()
                    ->loggedIn() ? 'authenticated' : null,
            ]),
        );

        if (! ($cachedView = cache($cacheName))) {
            $data = [
                'metatags' => get_post_metatags($this->post),
                'post'     => $this->post,
                'podcast'  => $this->podcast,
            ];

            // if user is logged in then send to the authenticated activity view
            if (auth()->loggedIn()) {
                helper('form');
                return view('post/post', $data);
            }

            return view('post/post', $data, [
                'cache'      => DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $cachedView;
    }

    public function attemptCreate(): RedirectResponse
    {
        $rules = [
            'message'     => 'required|max_length[500]',
            'episode_url' => 'valid_url_strict|permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $message = $this->request->getPost('message');

        $newPost = new CastopodPost([
            'actor_id'     => interact_as_actor_id(),
            'published_at' => Time::now(),
            'created_by'   => user_id(),
        ]);

        // get episode if episodeUrl has been set
        $episodeUri = $this->request->getPost('episode_url');
        if (
            $episodeUri &&
            ($params = extract_params_from_episode_uri(new URI($episodeUri))) &&
            ($episode = (new EpisodeModel())->getEpisodeBySlug($params['podcastHandle'], $params['episodeSlug']))
        ) {
            $newPost->episode_id = $episode->id;
        }

        $newPost->message = $message;

        $postModel = new PostModel();
        if (
            ! $postModel
                ->addPost($newPost, ! (bool) $newPost->episode_id, true)
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $postModel->errors());
        }

        // Post has been successfully created
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

        $newPost = new CastopodPost([
            'actor_id'       => interact_as_actor_id(),
            'in_reply_to_id' => $this->post->id,
            'message'        => $this->request->getPost('message'),
            'published_at'   => Time::now(),
            'created_by'     => user_id(),
        ]);

        if ($this->post->episode_id !== null) {
            $newPost->episode_id = $this->post->episode_id;
        }

        $postModel = new PostModel();
        if (! $postModel->addReply($newPost)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $postModel->errors());
        }

        // Reply post without preview card has been successfully created
        return redirect()->back();
    }

    public function attemptFavourite(): RedirectResponse
    {
        model(FavouriteModel::class)->toggleFavourite(interact_as_actor(), $this->post);

        return redirect()->back();
    }

    public function attemptReblog(): RedirectResponse
    {
        (new PostModel())->toggleReblog(interact_as_actor(), $this->post);

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
            'reblog'    => $this->attemptReblog(),
            'reply'     => $this->attemptReply(),
            default     => redirect()
                ->back()
                ->withInput()
                ->with('errors', 'error'),
        };
    }

    public function remoteAction(string $action): string
    {
        // Prevent analytics hit when authenticated
        if (! auth()->loggedIn()) {
            $this->registerPodcastWebpageHit($this->podcast->id);
        }

        $cacheName = implode(
            '_',
            array_filter(['page', "post#{$this->post->id}", "remote_{$action}", service('request') ->getLocale()]),
        );

        if (! ($cachedView = cache($cacheName))) {
            $data = [
                'metatags' => get_remote_actions_metatags($this->post, $action),
                'podcast'  => $this->podcast,
                'actor'    => $this->actor,
                'post'     => $this->post,
                'action'   => $action,
            ];

            helper('form');

            return view('post/remote_action', $data, [
                'cache'      => DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return (string) $cachedView;
    }
}
