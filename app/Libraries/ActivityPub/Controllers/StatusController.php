<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Controllers;

use ActivityPub\Config\ActivityPub;
use ActivityPub\Entities\Status;
use ActivityPub\Objects\OrderedCollectionObject;
use ActivityPub\Objects\OrderedCollectionPage;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class StatusController extends Controller
{
    /**
     * @var string[]
     */
    protected $helpers = ['activitypub'];

    protected Status $status;

    protected ActivityPub $config;

    public function __construct()
    {
        $this->config = config('ActivityPub');
    }

    public function _remap(string $method, string ...$params): mixed
    {
        if (($status = model('StatusModel')->getStatusById($params[0])) === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->status = $status;

        unset($params[0]);

        return $this->{$method}(...$params);
    }

    /**
     * @noRector ReturnTypeDeclarationRector
     */
    public function index(): Response
    {
        $noteObjectClass = $this->config->noteObject;
        $noteObject = new $noteObjectClass($this->status);

        return $this->response
            ->setContentType('application/activity+json')
            ->setBody($noteObject->toJSON());
    }

    /**
     * @noRector ReturnTypeDeclarationRector
     */
    public function replies(): Response
    {
        /**
         * get status replies
         */
        $statusReplies = model('StatusModel')
            ->where('in_reply_to_id', service('uuid') ->fromString($this->status->id) ->getBytes())
            ->where('`published_at` <= NOW()', null, false)
            ->orderBy('published_at', 'ASC');

        $pageNumber = (int) $this->request->getGet('page');

        if ($pageNumber < 1) {
            $statusReplies->paginate(12);
            $pager = $statusReplies->pager;
            $collection = new OrderedCollectionObject(null, $pager);
        } else {
            $paginatedReplies = $statusReplies->paginate(12, 'default', $pageNumber);
            $pager = $statusReplies->pager;

            $orderedItems = [];
            $noteObjectClass = $this->config->noteObject;

            if ($paginatedReplies !== null) {
                foreach ($paginatedReplies as $reply) {
                    $replyObject = new $noteObjectClass($reply);
                    $orderedItems[] = $replyObject->toJSON();
                }
            }

            $collection = new OrderedCollectionPage($pager, $orderedItems);
        }

        return $this->response
            ->setContentType('application/activity+json')
            ->setBody($collection->toJSON());
    }

    public function attemptCreate(): RedirectResponse
    {
        $rules = [
            'actor_id' => 'required|is_natural_no_zero',
            'message' => 'required|max_length[500]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $newStatus = new Status([
            'actor_id' => $this->request->getPost('actor_id'),
            'message' => $this->request->getPost('message'),
            'published_at' => Time::now(),
        ]);

        if (! model('StatusModel')->addStatus($newStatus)) {
            return redirect()
                ->back()
                ->withInput()
                // TODO: translate
                ->with('error', "Couldn't create Status");
        }

        // Status without preview card has been successfully created
        return redirect()->back();
    }

    public function attemptFavourite(): RedirectResponse
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

        $actor = model('ActorModel')
            ->getActorById($this->request->getPost('actor_id'));

        model('FavouriteModel')
            ->toggleFavourite($actor, $this->status->id);

        return redirect()->back();
    }

    public function attemptReblog(): RedirectResponse
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

        $actor = model('ActorModel')
            ->getActorById($this->request->getPost('actor_id'));

        model('StatusModel')
            ->toggleReblog($actor, $this->status);

        return redirect()->back();
    }

    public function attemptReply(): RedirectResponse
    {
        $rules = [
            'actor_id' => 'required|is_natural_no_zero',
            'message' => 'required|max_length[500]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $newReplyStatus = new Status([
            'actor_id' => $this->request->getPost('actor_id'),
            'in_reply_to_id' => $this->status->id,
            'message' => $this->request->getPost('message'),
            'published_at' => Time::now(),
        ]);

        if (! model('StatusModel')->addReply($newReplyStatus)) {
            return redirect()
                ->back()
                ->withInput()
                // TODO: translate
                ->with('error', "Couldn't create Reply");
        }

        // Reply status without preview card has been successfully created
        return redirect()->back();
    }

    public function attemptRemoteAction(string $action): RedirectResponse | ResponseInterface
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
            // TODO: error, couldn't remote favourite/share/reply to status
            // The instance doesn't allow its users remote actions on statuses
            return $this->response->setJSON([]);
        }

        return redirect()->to(
            str_replace('{uri}', urlencode($this->status->uri), $data->links[$ostatusKey]->template),
        );
    }

    public function attemptBlockActor(): RedirectResponse
    {
        model('ActorModel')->blockActor($this->status->actor->id);

        return redirect()->back();
    }

    public function attemptBlockDomain(): RedirectResponse
    {
        model('BlockedDomainModel')->blockDomain($this->status->actor->domain);

        return redirect()->back();
    }

    public function attemptDelete(): RedirectResponse
    {
        model('StatusModel', false)->removeStatus($this->status);

        return redirect()->back();
    }
}
