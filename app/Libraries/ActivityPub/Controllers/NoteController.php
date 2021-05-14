<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;
use ActivityPub\Entities\Note;
use ActivityPub\Config\ActivityPub;
use ActivityPub\Models\NoteModel;
use ActivityPub\Objects\OrderedCollectionObject;
use ActivityPub\Objects\OrderedCollectionPage;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class NoteController extends Controller
{
    /**
     * @var string[]
     */
    protected $helpers = ['activitypub'];

    /**
     * @var Note
     */
    protected $note;

    /**
     * @var ActivityPub
     */
    protected $config;

    public function __construct()
    {
        $this->config = config('ActivityPub');
    }

    public function _remap(string $method, string ...$params): mixed
    {
        if (!($this->note = model('NoteModel')->getNoteById($params[0]))) {
            throw PageNotFoundException::forPageNotFound();
        }
        unset($params[0]);

        return $this->$method(...$params);
    }

    public function index(): RedirectResponse
    {
        $noteObjectClass = $this->config->noteObject;
        $noteObject = new $noteObjectClass($this->note);

        return $this->response
            ->setContentType('application/activity+json')
            ->setBody($noteObject->toJSON());
    }

    public function replies(): RedirectResponse
    {
        /** get note replies */
        $noteReplies = model('NoteModel')
            ->where(
                'in_reply_to_id',
                service('uuid')
                    ->fromString($this->note->id)
                    ->getBytes(),
            )
            ->where('`published_at` <= NOW()', null, false)
            ->orderBy('published_at', 'ASC');

        $pageNumber = $this->request->getGet('page');

        if (!isset($pageNumber)) {
            $noteReplies->paginate(12);
            $pager = $noteReplies->pager;
            $collection = new OrderedCollectionObject(null, $pager);
        } else {
            $paginatedReplies = $noteReplies->paginate(
                12,
                'default',
                $pageNumber,
            );
            $pager = $noteReplies->pager;

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

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $newNote = new Note([
            'actor_id' => $this->request->getPost('actor_id'),
            'message' => $this->request->getPost('message'),
            'published_at' => Time::now(),
        ]);

        if (!model('NoteModel')->addNote($newNote)) {
            return redirect()
                ->back()
                ->withInput()
                // TODO: translate
                ->with('error', "Couldn't create Note");
        }

        // Note without preview card has been successfully created
        return redirect()->back();
    }

    public function attemptFavourite(): RedirectResponse
    {
        $rules = [
            'actor_id' => 'required|is_natural_no_zero',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $actor = model('ActorModel')->getActorById(
            $this->request->getPost('actor_id'),
        );

        model('FavouriteModel')->toggleFavourite($actor, $this->note->id);

        return redirect()->back();
    }

    public function attemptReblog(): RedirectResponse
    {
        $rules = [
            'actor_id' => 'required|is_natural_no_zero',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $actor = model('ActorModel')->getActorById(
            $this->request->getPost('actor_id'),
        );

        model('NoteModel')->toggleReblog($actor, $this->note);

        return redirect()->back();
    }

    public function attemptReply(): RedirectResponse
    {
        $rules = [
            'actor_id' => 'required|is_natural_no_zero',
            'message' => 'required|max_length[500]',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $newReplyNote = new Note([
            'actor_id' => $this->request->getPost('actor_id'),
            'in_reply_to_id' => $this->note->id,
            'message' => $this->request->getPost('message'),
            'published_at' => Time::now(),
        ]);

        if (!model('NoteModel')->addReply($newReplyNote)) {
            return redirect()
                ->back()
                ->withInput()
                // TODO: translate
                ->with('error', "Couldn't create Reply");
        }

        // Reply note without preview card has been successfully created
        return redirect()->back();
    }

    public function attemptRemoteAction(string $action): RedirectResponse|ResponseInterface
    {
        $rules = [
            'handle' =>
                'regex_match[/^@?(?P<username>[\w\.\-]+)@(?P<host>[\w\.\-]+)(?P<port>:[\d]+)?$/]',
        ];

        if (!$this->validate($rules)) {
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
            !($parts = split_handle($this->request->getPost('handle'))) ||
            !($data = get_webfinger_data($parts['username'], $parts['domain']))
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', lang('ActivityPub.follow.accountNotFound'));
        }

        $ostatusKey = array_search(
            'http://ostatus.org/schema/1.0/subscribe',
            array_column($data->links, 'rel'),
        );

        if (!$ostatusKey) {
            // TODO: error, couldn't remote favourite/share/reply to note
            // The instance doesn't allow its users remote actions on notes
            return $this->response->setJSON([]);
        }

        return redirect()->to(
            str_replace(
                '{uri}',
                urlencode($this->note->uri),
                $data->links[$ostatusKey]->template,
            ),
        );
    }

    public function attemptBlockActor(): RedirectResponse
    {
        model('ActorModel')->blockActor($this->note->actor->id);

        return redirect()->back();
    }

    public function attemptBlockDomain(): RedirectResponse
    {
        model('BlockedDomainModel')->blockDomain($this->note->actor->domain);

        return redirect()->back();
    }

    public function attemptDelete(): RedirectResponse
    {
        model('NoteModel', false)->removeNote($this->note);

        return redirect()->back();
    }
}
