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
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use Modules\Fediverse\Config\Fediverse;
use Modules\Fediverse\Entities\Post;
use Modules\Fediverse\Objects\OrderedCollectionObject;
use Modules\Fediverse\Objects\OrderedCollectionPage;

class PostController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var IncomingRequest
     */
    protected $request;

    /**
     * @var list<string>
     */
    protected $helpers = ['fediverse'];

    /**
     * @var Post
     */
    protected $post;

    protected Fediverse $config;

    public function __construct()
    {
        $this->config = config('Fediverse');
    }

    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (! ($post = model('PostModel', false)->getPostById($params[0])) instanceof Post) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->post = $post;

        unset($params[0]);

        return $this->{$method}(...$params);
    }

    public function index(): ResponseInterface
    {
        $noteObjectClass = $this->config->noteObject;
        $noteObject = new $noteObjectClass($this->post);

        return $this->response
            ->setContentType('application/activity+json')
            ->setBody($noteObject->toJSON());
    }

    public function replies(): ResponseInterface
    {
        /**
         * get post replies
         */
        $postReplies = model('PostModel', false)
            ->where('in_reply_to_id', service('uuid') ->fromString($this->post->id) ->getBytes())
            ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
            ->orderBy('published_at', 'ASC');

        $pageNumber = (int) $this->request->getGet('page');

        if ($pageNumber < 1) {
            $postReplies->paginate(12);
            $pager = $postReplies->pager;
            $collection = new OrderedCollectionObject(null, $pager);
        } else {
            $paginatedReplies = $postReplies->paginate(12, 'default', $pageNumber);
            $pager = $postReplies->pager;

            $orderedItems = [];
            $noteObjectClass = $this->config->noteObject;

            foreach ($paginatedReplies as $reply) {
                $replyObject = new $noteObjectClass($reply);
                $orderedItems[] = $replyObject->toArray();
            }

            $collection = new OrderedCollectionPage($pager, $orderedItems);
        }

        return $this->response
            ->setContentType('application/activity+json')
            ->setBody($collection->toJSON());
    }

    public function createAction(): RedirectResponse
    {
        $rules = [
            'actor_id' => 'required|is_natural_no_zero',
            'message'  => 'required|max_length[500]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        $newPost = new Post([
            'actor_id'     => $validData['actor_id'],
            'message'      => $validData['message'],
            'published_at' => Time::now(),
        ]);

        $postModel = model('PostModel', false);
        if (! $postModel->addPost($newPost)) {
            return redirect()
                ->back()
                ->withInput()
                // TODO: translate
                ->with('error', $postModel->errors());
        }

        // Post without preview card has been successfully created
        return redirect()->back();
    }

    public function favouriteAction(): RedirectResponse
    {
        $rules = [
            'actor_id' => 'required|is_natural_no_zero',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        $actor = model('ActorModel', false)
            ->getActorById($validData['actor_id']);

        model('FavouriteModel', false)
            ->toggleFavourite($actor, $this->post);

        return redirect()->back();
    }

    public function reblogAction(): RedirectResponse
    {
        $rules = [
            'actor_id' => 'required|is_natural_no_zero',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        $actor = model('ActorModel', false)
            ->getActorById($validData['actor_id']);

        model('PostModel', false)
            ->toggleReblog($actor, $this->post);

        return redirect()->back();
    }

    public function replyAction(): RedirectResponse
    {
        $rules = [
            'actor_id' => 'required|is_natural_no_zero',
            'message'  => 'required|max_length[500]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        $newReplyPost = new Post([
            'actor_id'       => $validData['actor_id'],
            'in_reply_to_id' => $this->post->id,
            'message'        => $validData['message'],
            'published_at'   => Time::now(),
        ]);

        if (! model('PostModel', false)->addReply($newReplyPost)) {
            return redirect()
                ->back()
                ->withInput()
                // TODO: translate
                ->with('error', "Couldn't create Reply");
        }

        // Reply post without preview card has been successfully created
        return redirect()->back();
    }

    public function remoteActionAction(string $action): RedirectResponse | ResponseInterface
    {
        $rules = [
            'handle' => 'regex_match[/^@?(?P<username>[\w\.\-]+)@(?P<host>[\w\.\-]+)(?P<port>:[\d]+)?$/]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        helper('text');

        // get webfinger data from actor
        // parse actor id to get actor and domain
        // check if actor and domain exist
        if (
            ! ($parts = split_handle($validData['handle'])) ||
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
            // TODO: error, couldn't remote favourite/share/reply to post
            // The instance doesn't allow its users remote actions on posts
            return $this->response->setJSON([]);
        }

        return redirect()->to(
            str_replace('{uri}', urlencode($this->post->uri), (string) $data->links[$ostatusKey]->template),
        );
    }

    public function blockActorAction(): RedirectResponse
    {
        model('ActorModel', false)->blockActor($this->post->actor->id);

        return redirect()->back();
    }

    public function blockDomainAction(): RedirectResponse
    {
        model('BlockedDomainModel', false)->blockDomain($this->post->actor->domain);

        return redirect()->back();
    }

    public function deleteAction(): RedirectResponse
    {
        model('PostModel', false)->removePost($this->post);

        return redirect()->back();
    }
}
