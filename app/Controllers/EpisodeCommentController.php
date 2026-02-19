<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Entities\Episode;
use App\Entities\EpisodeComment;
use App\Entities\Podcast;
use App\Libraries\CommentObject;
use App\Models\EpisodeCommentModel;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use Modules\Analytics\AnalyticsTrait;
use Modules\Fediverse\Entities\Actor;
use Modules\Fediverse\Objects\OrderedCollectionObject;
use Modules\Fediverse\Objects\OrderedCollectionPage;

class EpisodeCommentController extends BaseController
{
    use AnalyticsTrait;

    protected Podcast $podcast;

    protected Actor $actor;

    protected Episode $episode;

    protected EpisodeComment $comment;

    public function _remap(string $method, string ...$params): mixed
    {
        if (count($params) < 3) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (
            ! ($podcast = new PodcastModel()->getPodcastByHandle($params[0])) instanceof Podcast
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->podcast = $podcast;
        $this->actor = $podcast->actor;

        if (
            ! ($episode = new EpisodeModel()->getEpisodeBySlug($params[0], $params[1])) instanceof Episode
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->episode = $episode;

        if (
            ! ($comment = new EpisodeCommentModel()->getCommentById($params[2])) instanceof EpisodeComment
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->comment = $comment;

        unset($params[2]);
        unset($params[1]);
        unset($params[0]);

        return $this->{$method}(...$params);
    }

    public function view(): string
    {
        $this->registerPodcastWebpageHit($this->podcast->id);

        $cacheName = implode(
            '_',
            array_filter([
                'page',
                "episode#{$this->episode->id}",
                "comment#{$this->comment->id}",
                service('request')
                    ->getLocale(),
                auth()
                    ->loggedIn() ? 'authenticated' : null,
            ]),
        );

        if (! ($cachedView = cache($cacheName))) {
            set_episode_comment_metatags($this->comment);
            $data = [
                'podcast' => $this->podcast,
                'actor'   => $this->actor,
                'episode' => $this->episode,
                'comment' => $this->comment,
            ];

            // if user is logged in then send to the authenticated activity view
            if (auth()->loggedIn()) {
                helper('form');
                return view('episode/comment', $data);
            }

            return view('episode/comment', $data, [
                'cache'      => DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $cachedView;
    }

    public function commentObject(): ResponseInterface
    {
        $commentObject = new CommentObject($this->comment);

        return $this->response
            ->setContentType('application/json')
            ->setBody($commentObject->toJSON());
    }

    public function replies(): ResponseInterface
    {
        /**
         * get comment replies
         */
        $commentReplies = model(EpisodeCommentModel::class, false)
            ->where('in_reply_to_id', service('uuid')->fromString($this->comment->id)->getBytes())
            ->orderBy('created_at', 'ASC');

        $pageNumber = (int) $this->request->getGet('page');

        if ($pageNumber < 1) {
            $commentReplies->paginate(12);
            $pager = $commentReplies->pager;
            $collection = new OrderedCollectionObject(null, $pager);
        } else {
            $paginatedReplies = $commentReplies->paginate(12, 'default', $pageNumber);
            $pager = $commentReplies->pager;

            $orderedItems = [];
            foreach ($paginatedReplies as $reply) {
                $replyObject = new CommentObject($reply);
                $orderedItems[] = $replyObject;
            }

            $collection = new OrderedCollectionPage($pager, $orderedItems);
        }

        return $this->response
            ->setContentType('application/activity+json')
            ->setBody($collection->toJSON());
    }

    public function likeAction(): RedirectResponse
    {
        if (! ($interactAsActor = interact_as_actor()) instanceof Actor) {
            return redirect()->back();
        }

        model('LikeModel')
            ->toggleLike($interactAsActor, $this->comment);

        return redirect()->back();
    }

    public function replyAction(): RedirectResponse
    {
        if (! ($interactAsActor = interact_as_actor()) instanceof Actor) {
            return redirect()->back();
        }

        model('LikeModel')
            ->toggleLike($interactAsActor, $this->comment);

        return redirect()->back();
    }
}
