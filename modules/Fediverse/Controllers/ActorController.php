<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use Modules\Fediverse\Config\Fediverse;
use Modules\Fediverse\Entities\Actor;
use Modules\Fediverse\Entities\Post;
use Modules\Fediverse\Objects\OrderedCollectionObject;
use Modules\Fediverse\Objects\OrderedCollectionPage;

class ActorController extends Controller
{
    /**
     * @var string[]
     */
    protected $helpers = ['fediverse'];

    protected Actor $actor;

    protected Fediverse $config;

    public function __construct()
    {
        $this->config = config('Fediverse');
    }

    public function _remap(string $method, string ...$params): mixed
    {
        if (count($params) < 1) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (
            ($actor = model('ActorModel', false)->getActorByUsername($params[0])) === null
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->actor = $actor;
        unset($params[0]);

        return $this->{$method}(...$params);
    }

    /**
     * @noRector ReturnTypeDeclarationRector
     */
    public function index(): ResponseInterface
    {
        $actorObjectClass = $this->config->actorObject;
        $actorObject = new $actorObjectClass($this->actor);

        return $this->response
            ->setContentType('application/activity+json')
            ->setBody($actorObject->toJSON());
    }

    /**
     * Handles incoming requests from fediverse servers
     *
     * @noRector ReturnTypeDeclarationRector
     */
    public function inbox(): ResponseInterface
    {
        // get json body and parse it
        $payload = $this->request->getJSON();

        // retrieve payload actor from database or create it if it doesn't exist
        $payloadActor = get_or_create_actor_from_uri($payload->actor);

        // store activity to database
        $activityId = model('ActivityModel', false)
            ->newActivity(
                $payload->type,
                $payloadActor->id,
                $this->actor->id,
                null,
                json_encode($payload, JSON_THROW_ON_ERROR),
            );

        // switch/case on activity type
        /** @phpstan-ignore-next-line */
        switch ($payload->type) {
            case 'Create':
                if ($payload->object->type === 'Note') {
                    if (! $payload->object->inReplyTo) {
                        return $this->response->setStatusCode(501)
                            ->setJSON([]);
                    }

                    $replyToPost = model('PostModel', false)
                        ->getPostByUri($payload->object->inReplyTo);

                    $reply = null;
                    if ($replyToPost !== null) {
                        // TODO: strip content from html to retrieve message
                        // remove all html tags and reconstruct message with mentions?
                        $message = get_message_from_object($payload->object);

                        $reply = new Post([
                            'uri' => $payload->object->id,
                            'actor_id' => $payloadActor->id,
                            'in_reply_to_id' => $replyToPost->id,
                            'message' => $message,
                            'published_at' => Time::parse($payload->object->published),
                        ]);
                    }

                    if ($reply !== null) {
                        $postId = model('PostModel', false)
                            ->addReply($reply, true, false);

                        model('ActivityModel', false)
                            ->update($activityId, [
                                'post_id' => $postId,
                            ]);
                    }

                    return $this->response->setStatusCode(200)
                        ->setJSON([]);
                }

                // return not handled undo error (501 = not implemented)
                return $this->response->setStatusCode(501)
                    ->setJSON([]);
            case 'Delete':
                $postToDelete = model('PostModel', false)
                    ->getPostByUri($payload->object->id);

                if ($postToDelete !== null) {
                    model('PostModel', false)
                        ->removePost($postToDelete, false);
                }

                return $this->response->setStatusCode(200)
                    ->setJSON([]);
            case 'Follow':
                // add to followers table
                model('FollowModel', false)
                    ->addFollower($payloadActor, $this->actor, false);

                // Automatically accept follow by returning accept activity
                accept_follow($this->actor, $payloadActor, $payload->id);

                // TODO: return 202 (Accepted) followed!
                return $this->response->setStatusCode(202)
                    ->setJSON([]);

            case 'Like':
                // get favourited post
                $post = model('PostModel', false)
                    ->getPostByUri($payload->object);

                if ($post !== null) {
                    // Like side-effect
                    model('FavouriteModel', false)
                        ->addFavourite($payloadActor, $post, false);

                    model('ActivityModel', false)
                        ->update($activityId, [
                            'post_id' => $post->id,
                        ]);
                }

                return $this->response->setStatusCode(200)
                    ->setJSON([]);
            case 'Announce':
                $post = model('PostModel', false)
                    ->getPostByUri($payload->object);

                if ($post !== null) {
                    model('ActivityModel', false)
                        ->update($activityId, [
                            'post_id' => $post->id,
                        ]);

                    model('PostModel', false)
                        ->reblog($payloadActor, $post, false);
                }

                return $this->response->setStatusCode(200)
                    ->setJSON([]);
            case 'Undo':
                // switch/case on the type of activity to undo
                /** @phpstan-ignore-next-line */
                switch ($payload->object->type) {
                    case 'Follow':
                        // revert side-effect by removing follow from database
                        model('FollowModel', false)
                            ->removeFollower($payloadActor, $this->actor, false);

                        // TODO: undo has been accepted! (202 - Accepted)
                        return $this->response->setStatusCode(202)
                            ->setJSON([]);
                    case 'Like':
                        $post = model('PostModel', false)
                            ->getPostByUri($payload->object->object);

                        if ($post !== null) {
                            // revert side-effect by removing favourite from database
                            model('FavouriteModel', false)
                                ->removeFavourite($payloadActor, $post, false);

                            model('ActivityModel', false)
                                ->update($activityId, [
                                    'post_id' => $post->id,
                                ]);
                        }

                        return $this->response->setStatusCode(200)
                            ->setJSON([]);
                    case 'Announce':
                        $post = model('PostModel', false)
                            ->getPostByUri($payload->object->object);

                        $reblogPost = null;
                        if ($post !== null) {
                            $reblogPost = model('PostModel', false)
                                ->where([
                                    'actor_id' => $payloadActor->id,
                                    'reblog_of_id' => service('uuid')
                                        ->fromString($post->id)
                                        ->getBytes(),
                                ])
                                ->first();
                        }

                        if ($reblogPost !== null) {
                            model('PostModel', false)
                                ->undoReblog($reblogPost, false);

                            model('ActivityModel', false)
                                ->update($activityId, [
                                    'post_id' => $post->id,
                                ]);
                        }

                        return $this->response->setStatusCode(200)
                            ->setJSON([]);
                    default:
                        // return not handled undo error (501 = not implemented)
                        return $this->response->setStatusCode(501)
                            ->setJSON([]);
                }
                // no break
            default:
                // return not handled activity error (501 = not implemented)
                return $this->response->setStatusCode(501)
                    ->setJSON([]);
        }
    }

    /**
     * @noRector ReturnTypeDeclarationRector
     */
    public function outbox(): ResponseInterface
    {
        // get published activities by publication date
        $actorActivity = model('ActivityModel', false)
            ->where('actor_id', $this->actor->id)
            ->where('`created_at` <= NOW()', null, false)
            ->orderBy('created_at', 'DESC');

        $pageNumber = (int) $this->request->getGet('page');

        if ($pageNumber < 1) {
            $actorActivity->paginate(12);
            $pager = $actorActivity->pager;
            $collection = new OrderedCollectionObject(null, $pager);
        } else {
            $paginatedActivity = $actorActivity->paginate(12, 'default', $pageNumber);
            $pager = $actorActivity->pager;
            $orderedItems = [];
            foreach ($paginatedActivity as $activity) {
                $orderedItems[] = $activity->payload;
            }

            $collection = new OrderedCollectionPage($pager, $orderedItems);
        }

        return $this->response
            ->setContentType('application/activity+json')
            ->setBody($collection->toJSON());
    }

    /**
     * @noRector ReturnTypeDeclarationRector
     */
    public function followers(): ResponseInterface
    {
        $tablesPrefix = config('Fediverse')
            ->tablesPrefix;

        // get followers for a specific actor
        $followers = model('ActorModel', false)
            ->join($tablesPrefix . 'follows', $tablesPrefix . 'follows.actor_id = id', 'inner')
            ->where($tablesPrefix . 'follows.target_actor_id', $this->actor->id)
            ->orderBy($tablesPrefix . 'follows.created_at', 'DESC');

        $pageNumber = (int) $this->request->getGet('page');

        if ($pageNumber < 1) {
            $followers->paginate(12);
            $pager = $followers->pager;
            $followersCollection = new OrderedCollectionObject(null, $pager);
        } else {
            $paginatedFollowers = $followers->paginate(12, 'default', $pageNumber);
            $pager = $followers->pager;

            $orderedItems = [];
            foreach ($paginatedFollowers as $follower) {
                $orderedItems[] = $follower->uri;
            }

            $followersCollection = new OrderedCollectionPage($pager, $orderedItems);
        }

        return $this->response
            ->setContentType('application/activity+json')
            ->setBody($followersCollection->toJSON());
    }

    public function attemptFollow(): RedirectResponse | ResponseInterface
    {
        $rules = [
            'handle' =>
                'regex_match[/^@?(?P<username>[\w\.\-]+)@(?P<host>[\w\.\-]+)(?P<port>:[\d]+)?$/]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        helper('text');

        // get webfinger data from actor
        // parse actor id to get actor and domain
        // check if actor and domain exist

        if (
            ! ($parts = split_handle($this->request->getPost('handle'))) ||
            ! ($data = get_webfinger_data($parts['username'], $parts['domain']))
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', lang('Fediverse.follow.accountNotFound'));
        }

        $ostatusKey = array_search(
            'http://ostatus.org/schema/1.0/subscribe',
            array_column($data->links, 'rel'),
            true,
        );

        if (! $ostatusKey) {
            // TODO: error, couldn't subscribe to activitypub account
            // The instance doesn't allow its users to follow others
            return $this->response->setJSON([]);
        }

        return redirect()->to(
            str_replace('{uri}', urlencode($this->actor->uri), $data->links[$ostatusKey]->template),
        );
    }

    /**
     * @noRector ReturnTypeDeclarationRector
     */
    public function activity(string $activityId): ResponseInterface
    {
        if (
            ! ($activity = model('ActivityModel', false)->getActivityById($activityId))
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setContentType('application/activity+json')
            ->setBody(json_encode($activity->payload, JSON_THROW_ON_ERROR));
    }
}
