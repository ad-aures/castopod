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
use Override;

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
     * @var list<string>
     */
    protected $helpers = ['auth', 'fediverse', 'svg', 'components', 'misc', 'seo', 'premium_podcasts'];

    #[Override]
    public function _remap(string $method, string ...$params): mixed
    {

        if (
            ! ($podcast = (new PodcastModel())->getPodcastByHandle($params[0])) instanceof Podcast
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->podcast = $podcast;
        $this->actor = $this->podcast->actor;

        if (count($params) <= 1) {
            unset($params[0]);

            return $this->{$method}(...$params);
        }

        if (
            ! ($post = (new PostModel())->getPostById($params[1])) instanceof CastopodPost
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->post = $post;

        unset($params[0]);
        unset($params[1]);

        return $this->{$method}(...$params);
    }

    public function view(): string
    {
        $this->registerPodcastWebpageHit($this->podcast->id);

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
            set_post_metatags($this->post);
            $data = [
                'post'    => $this->post,
                'podcast' => $this->podcast,
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

    #[Override]
    public function createAction(): RedirectResponse
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

        $validData = $this->validator->getValidated();

        $message = $validData['message'];

        $newPost = new CastopodPost([
            'actor_id'     => interact_as_actor_id(),
            'published_at' => Time::now(),
            'created_by'   => user_id(),
        ]);

        // get episode if episodeUrl has been set
        $episodeUri = $validData['episode_url'];
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

    #[Override]
    public function replyAction(): RedirectResponse
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

        $validData = $this->validator->getValidated();

        $newPost = new CastopodPost([
            'actor_id'       => interact_as_actor_id(),
            'in_reply_to_id' => $this->post->id,
            'message'        => $validData['message'],
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

    #[Override]
    public function favouriteAction(): RedirectResponse
    {
        model('FavouriteModel')->toggleFavourite(interact_as_actor(), $this->post);

        return redirect()->back();
    }

    #[Override]
    public function reblogAction(): RedirectResponse
    {
        (new PostModel())->toggleReblog(interact_as_actor(), $this->post);

        return redirect()->back();
    }

    public function action(): RedirectResponse
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

        $validData = $this->validator->getValidated();

        $action = $validData['action'];
        return match ($action) {
            'favourite' => $this->favouriteAction(),
            'reblog'    => $this->reblogAction(),
            'reply'     => $this->replyAction(),
            default     => redirect()
                ->back()
                ->withInput()
                ->with('errors', 'error'),
        };
    }

    public function remoteActionView(string $action): string
    {
        $this->registerPodcastWebpageHit($this->podcast->id);

        set_remote_actions_metatags($this->post, $action);
        $data = [
            'podcast' => $this->podcast,
            'actor'   => $this->actor,
            'post'    => $this->post,
            'action'  => $action,
        ];

        helper('form');

        // NO VIEW CACHING: form has a CSRF token which should change on each request
        return view('post/remote_action', $data);
    }
}
