<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Controllers;

use ActivityPub\Config\ActivityPub;
use ActivityPub\Entities\Actor;
use ActivityPub\Entities\Status;
use ActivityPub\Objects\OrderedCollectionObject;
use ActivityPub\Objects\OrderedCollectionPage;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class ActorController extends Controller
{
    /**
     * @var string[]
     */
    protected $helpers = ['activitypub'];

    protected Actor $actor;

    protected ActivityPub $config;

    public function __construct()
    {
        $this->config = config('ActivityPub');
    }

    public function _remap(string $method, string ...$params): mixed
    {
        if (count($params) < 1) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (
            ($actor = model('ActorModel')->getActorByUsername($params[0])) === null
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
        $activityId = model('ActivityModel')
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

                    $replyToStatus = model('StatusModel')
                        ->getStatusByUri($payload->object->inReplyTo);

                    $reply = null;
                    if ($replyToStatus !== null) {
                        // TODO: strip content from html to retrieve message
                        // remove all html tags and reconstruct message with mentions?
                        extract_text_from_html($payload->object->content);
                        $reply = new Status([
                            'uri' => $payload->object->id,
                            'actor_id' => $payloadActor->id,
                            'in_reply_to_id' => $replyToStatus->id,
                            'message' => $payload->object->content,
                            'published_at' => Time::parse($payload->object->published),
                        ]);
                    }

                    if ($reply !== null) {
                        $statusId = model('StatusModel')
                            ->addReply($reply, true, false);

                        model('ActivityModel')
                            ->update($activityId, [
                                'status_id' => $statusId,
                            ]);
                    }

                    return $this->response->setStatusCode(200)
                        ->setJSON([]);
                }
                // return not handled undo error (501 = not implemented)
                return $this->response->setStatusCode(501)
                    ->setJSON([]);
            case 'Delete':
                $statusToDelete = model('StatusModel')
                    ->getStatusByUri($payload->object->id);

                if ($statusToDelete !== null) {
                    model('StatusModel')
                        ->removeStatus($statusToDelete, false);
                }

                return $this->response->setStatusCode(200)
                    ->setJSON([]);
            case 'Follow':
                // add to followers table
                model('FollowModel')
                    ->addFollower($payloadActor, $this->actor, false);

                // Automatically accept follow by returning accept activity
                accept_follow($this->actor, $payloadActor, $payload->id);

                // TODO: return 202 (Accepted) followed!
                return $this->response->setStatusCode(202)
                    ->setJSON([]);

            case 'Like':
                // get favourited status
                $status = model('StatusModel')
                    ->getStatusByUri($payload->object);

                if ($status !== null) {
                    // Like side-effect
                    model('FavouriteModel')
                        ->addFavourite($payloadActor, $status, false);

                    model('ActivityModel')
                        ->update($activityId, [
                            'status_id' => $status->id,
                        ]);
                }

                return $this->response->setStatusCode(200)
                    ->setJSON([]);
            case 'Announce':
                $status = model('StatusModel')
                    ->getStatusByUri($payload->object);

                if ($status !== null) {
                    model('ActivityModel')
                        ->update($activityId, [
                            'status_id' => $status->id,
                        ]);

                    model('StatusModel')
                        ->reblog($payloadActor, $status, false);
                }

                return $this->response->setStatusCode(200)
                    ->setJSON([]);
            case 'Undo':
                // switch/case on the type of activity to undo
                /** @phpstan-ignore-next-line */
                switch ($payload->object->type) {
                    case 'Follow':
                        // revert side-effect by removing follow from database
                        model('FollowModel')
                            ->removeFollower($payloadActor, $this->actor, false);

                        // TODO: undo has been accepted! (202 - Accepted)
                        return $this->response->setStatusCode(202)
                            ->setJSON([]);
                    case 'Like':
                        $status = model('StatusModel')
                            ->getStatusByUri($payload->object->object);

                        if ($status !== null) {
                            // revert side-effect by removing favourite from database
                            model('FavouriteModel')
                                ->removeFavourite($payloadActor, $status, false);

                            model('ActivityModel')
                                ->update($activityId, [
                                    'status_id' => $status->id,
                                ]);
                        }

                        return $this->response->setStatusCode(200)
                            ->setJSON([]);
                    case 'Announce':
                        $status = model('StatusModel')
                            ->getStatusByUri($payload->object->object);

                        $reblogStatus = null;
                        if ($status !== null) {
                            $reblogStatus = model('StatusModel')
                                ->where([
                                    'actor_id' => $payloadActor->id,
                                    'reblog_of_id' => service('uuid')
                                        ->fromString($status->id)
                                        ->getBytes(),
                                ])
                                ->first();
                        }

                        if ($reblogStatus !== null) {
                            model('StatusModel')
                                ->undoReblog($reblogStatus, false);

                            model('ActivityModel')
                                ->update($activityId, [
                                    'status_id' => $status->id,
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
        $actorActivity = model('ActivityModel')
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
        // get followers for a specific actor
        $followers = model('ActorModel')
            ->join('activitypub_follows', 'activitypub_follows.actor_id = id', 'inner')
            ->where('activitypub_follows.target_actor_id', $this->actor->id)
            ->orderBy('activitypub_follows.created_at', 'DESC');

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
        // parse activityPub id to get actor and domain
        // check if actor and domain exist

        if (
            ! ($parts = split_handle($this->request->getPost('handle'))) ||
            ! ($data = get_webfinger_data($parts['username'], $parts['domain']))
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', lang('ActivityPub.follow.accountNotFound'));
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
            ! ($activity = model('ActivityModel')->getActivityById($activityId))
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setContentType('application/activity+json')
            ->setBody(json_encode($activity->payload, JSON_THROW_ON_ERROR));
    }
}
