<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Models;

use ActivityPub\Entities\Note;
use ActivityPub\Activities\AnnounceActivity;
use ActivityPub\Activities\CreateActivity;
use ActivityPub\Activities\DeleteActivity;
use ActivityPub\Activities\UndoActivity;
use ActivityPub\Objects\TombstoneObject;
use CodeIgniter\Events\Events;
use CodeIgniter\HTTP\URI;
use CodeIgniter\I18n\Time;

class NoteModel extends UuidModel
{
    protected $table = 'activitypub_notes';
    protected $primaryKey = 'id';

    protected $uuidFields = ['id', 'in_reply_to_id', 'reblog_of_id'];

    protected $allowedFields = [
        'id',
        'uri',
        'actor_id',
        'in_reply_to_id',
        'reblog_of_id',
        'message',
        'message_html',
        'favourites_count',
        'reblogs_count',
        'replies_count',
        'published_at',
    ];

    protected $returnType = \ActivityPub\Entities\Note::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;
    protected $updatedField = null;

    protected $validationRules = [
        'actor_id' => 'required',
        'message_html' => 'required_without[reblog_of_id]|max_length[500]',
    ];

    protected $beforeInsert = ['setNoteId'];

    public function getNoteById($noteId)
    {
        return $this->find($noteId);
    }

    public function getNoteByUri($noteUri)
    {
        return $this->where('uri', $noteUri)->first();
    }

    /**
     * Retrieves all published notes for a given actor ordered by publication date
     *
     * @return \ActivityPub\Entities\Note[]
     */
    public function getActorNotes($actorId)
    {
        return $this->where([
            'actor_id' => $actorId,
            'in_reply_to_id' => null,
        ])
            ->where('`published_at` <= NOW()', null, false)
            ->orderBy('published_at', 'DESC')
            ->findAll();
    }

    /**
     * Retrieves all published replies for a given note.
     * By default, it does not get replies from blocked actors.
     *
     * @param mixed $noteId
     * @param boolean $withBlocked false by default
     * @return array
     */
    public function getNoteReplies($noteId, $withBlocked = false)
    {
        if (!$withBlocked) {
            $this->select('activitypub_notes.*')
                ->join(
                    'activitypub_actors',
                    'activitypub_actors.id = activitypub_notes.actor_id',
                    'inner',
                )
                ->where('activitypub_actors.is_blocked', 0);
        }

        $this->where(
            'in_reply_to_id',
            service('uuid')
                ->fromString($noteId)
                ->getBytes(),
        )
            ->where('`published_at` <= NOW()', null, false)
            ->orderBy('published_at', 'ASC');

        return $this->findAll();
    }

    /**
     * Retrieves all published reblogs for a given note
     */
    public function getNoteReblogs($noteId)
    {
        return $this->where('reblog_of_id', $noteId)
            ->where('`published_at` <= NOW()', null, false)
            ->orderBy('published_at', 'ASC')
            ->findAll();
    }

    public function addPreviewCard($noteId, $previewCardId)
    {
        return $this->db->table('activitypub_notes_preview_cards')->insert([
            'note_id' => $noteId,
            'preview_card_id' => $previewCardId,
        ]);
    }

    /**
     * Adds note in database along preview card if relevant
     *
     * @param \ActivityPub\Entities\Note $note
     * @param boolean $registerActivity
     * @param boolean $createPreviewCard
     * @return string|false returns the new note id if success or false otherwise
     */
    public function addNote(
        $note,
        $createPreviewCard = true,
        $registerActivity = true
    ) {
        helper('activitypub');

        $this->db->transStart();

        if (!($newNoteId = $this->insert($note, true))) {
            $this->db->transRollback();

            // Couldn't insert note
            return false;
        }

        if ($createPreviewCard) {
            // parse message
            $messageUrls = extract_urls_from_message($note->message);

            if (
                !empty($messageUrls) &&
                ($previewCard = get_or_create_preview_card_from_url(
                    new URI($messageUrls[0]),
                ))
            ) {
                if (!$this->addPreviewCard($newNoteId, $previewCard->id)) {
                    $this->db->transRollback();

                    // problem when linking note to preview card
                    return false;
                }

                $this->db->transComplete();

                return $newNoteId;
            }
        }

        model('ActorModel')
            ->where('id', $note->actor_id)
            ->increment('notes_count');

        Events::trigger('on_note_add', $note);

        if ($registerActivity) {
            $noteUuid = service('uuid')
                ->fromBytes($newNoteId)
                ->toString();

            // set note id and uri to construct NoteObject
            $note->id = $noteUuid;
            $note->uri = base_url(
                route_to('note', $note->actor->username, $noteUuid),
            );

            $createActivity = new CreateActivity();
            $noteObjectClass = config('ActivityPub')->noteObject;
            $createActivity
                ->set('actor', $note->actor->uri)
                ->set('object', new $noteObjectClass($note));

            $activityId = model('ActivityModel')->newActivity(
                'Create',
                $note->actor_id,
                null,
                $noteUuid,
                $createActivity->toJSON(),
                $note->published_at,
                'queued',
            );

            $createActivity->set(
                'id',
                base_url(
                    route_to('activity', $note->actor->username, $activityId),
                ),
            );

            model('ActivityModel')->update($activityId, [
                'payload' => $createActivity->toJSON(),
            ]);
        }

        $this->db->transComplete();

        return $newNoteId;
    }

    public function editNote($updatedNote)
    {
        $this->db->transStart();

        // update note create activity schedule in database
        $scheduledActivity = model('ActivityModel')
            ->where([
                'type' => 'Create',
                'note_id' => service('uuid')
                    ->fromString($updatedNote->id)
                    ->getBytes(),
            ])
            ->first();

        // update published date in payload
        $newPayload = $scheduledActivity->payload;
        $newPayload->object->published = $updatedNote->published_at->format(
            DATE_W3C,
        );
        model('ActivityModel')->update($scheduledActivity->id, [
            'payload' => json_encode($newPayload),
            'scheduled_at' => $updatedNote->published_at,
        ]);

        // update note
        $updateResult = $this->update($updatedNote->id, $updatedNote);

        $this->db->transComplete();

        return $updateResult;
    }

    /**
     * Removes a note from the database and decrements meta data
     *
     * @param \ActivityPub\Entities\Note $note
     * @return mixed
     */
    public function removeNote($note, $registerActivity = true)
    {
        $this->db->transStart();

        model('ActorModel')
            ->where('id', $note->actor_id)
            ->decrement('notes_count');

        if ($note->in_reply_to_id) {
            // Note to remove is a reply
            model('NoteModel')
                ->where(
                    'id',
                    service('uuid')
                        ->fromString($note->in_reply_to_id)
                        ->getBytes(),
                )
                ->decrement('replies_count');
        }

        // remove all reblogs
        foreach ($note->reblogs as $reblog) {
            $this->removeNote($reblog);
        }

        // remove all replies
        foreach ($note->replies as $reply) {
            $this->removeNote($reply);
        }

        Events::trigger('on_note_remove', $note);

        if ($registerActivity) {
            $deleteActivity = new DeleteActivity();
            $tombstoneObject = new TombstoneObject();
            $tombstoneObject->set('id', $note->uri);
            $deleteActivity
                ->set('actor', $note->actor->uri)
                ->set('object', $tombstoneObject);

            $activityId = model('ActivityModel')->newActivity(
                'Delete',
                $note->actor_id,
                null,
                null,
                $deleteActivity->toJSON(),
                Time::now(),
                'queued',
            );

            $deleteActivity->set(
                'id',
                base_url(
                    route_to('activity', $note->actor->username, $activityId),
                ),
            );

            model('ActivityModel')->update($activityId, [
                'payload' => $deleteActivity->toJSON(),
            ]);
        }

        $result = model('NoteModel', false)->delete($note->id);

        $this->db->transComplete();

        return $result;
    }

    public function addReply(
        $reply,
        $createPreviewCard = true,
        $registerActivity = true
    ) {
        if (!$reply->in_reply_to_id) {
            throw new \Exception('Passed note is not a reply!');
        }

        $this->db->transStart();

        $noteId = $this->addNote($reply, $createPreviewCard, $registerActivity);

        model('NoteModel')
            ->where(
                'id',
                service('uuid')
                    ->fromString($reply->in_reply_to_id)
                    ->getBytes(),
            )
            ->increment('replies_count');

        Events::trigger('on_note_reply', $reply);

        $this->db->transComplete();

        return $noteId;
    }

    /**
     *
     * @param \ActivityPub\Entities\Actor $actor
     * @param \ActivityPub\Entities\Note $note
     * @return ActivityPub\Models\BaseResult|int|string|false
     */
    public function reblog($actor, $note, $registerActivity = true)
    {
        $this->db->transStart();

        $reblog = new Note([
            'actor_id' => $actor->id,
            'reblog_of_id' => $note->id,
            'published_at' => Time::now(),
        ]);

        // add reblog
        $reblogId = $this->insert($reblog, true);

        model('ActorModel')
            ->where('id', $actor->id)
            ->increment('notes_count');

        model('NoteModel')
            ->where(
                'id',
                service('uuid')
                    ->fromString($note->id)
                    ->getBytes(),
            )
            ->increment('reblogs_count');

        Events::trigger('on_note_reblog', $actor, $note);

        if ($registerActivity) {
            $announceActivity = new AnnounceActivity($reblog);

            $activityId = model('ActivityModel')->newActivity(
                'Announce',
                $actor->id,
                null,
                $note->id,
                $announceActivity->toJSON(),
                $reblog->published_at,
                'queued',
            );

            $announceActivity->set(
                'id',
                base_url(
                    route_to('activity', $note->actor->username, $activityId),
                ),
            );

            model('ActivityModel')->update($activityId, [
                'payload' => $announceActivity->toJSON(),
            ]);
        }

        $this->db->transComplete();

        return $reblogId;
    }

    /**
     * @param \ActivityPub\Entities\Note $reblogNote
     * @return mixed
     */
    public function undoReblog($reblogNote, $registerActivity = true)
    {
        $this->db->transStart();

        model('ActorModel')
            ->where('id', $reblogNote->actor_id)
            ->decrement('notes_count');

        model('NoteModel')
            ->where(
                'id',
                service('uuid')
                    ->fromString($reblogNote->reblog_of_id)
                    ->getBytes(),
            )
            ->decrement('reblogs_count');

        Events::trigger('on_note_undo_reblog', $reblogNote);

        if ($registerActivity) {
            $undoActivity = new UndoActivity();
            // get like activity
            $activity = model('ActivityModel')
                ->where([
                    'type' => 'Announce',
                    'actor_id' => $reblogNote->actor_id,
                    'note_id' => service('uuid')
                        ->fromString($reblogNote->reblog_of_id)
                        ->getBytes(),
                ])
                ->first();

            $announceActivity = new AnnounceActivity($reblogNote);
            $announceActivity->set(
                'id',
                base_url(
                    route_to(
                        'activity',
                        $reblogNote->actor->username,
                        $activity->id,
                    ),
                ),
            );

            $undoActivity
                ->set('actor', $reblogNote->actor->uri)
                ->set('object', $announceActivity);

            $activityId = model('ActivityModel')->newActivity(
                'Undo',
                $reblogNote->actor_id,
                null,
                $reblogNote->reblog_of_id,
                $undoActivity->toJSON(),
                Time::now(),
                'queued',
            );

            $undoActivity->set(
                'id',
                base_url(
                    route_to(
                        'activity',
                        $reblogNote->actor->username,
                        $activityId,
                    ),
                ),
            );

            model('ActivityModel')->update($activityId, [
                'payload' => $undoActivity->toJSON(),
            ]);
        }

        $result = model('NoteModel', false)->delete($reblogNote->id);

        $this->db->transComplete();

        return $result;
    }

    public function toggleReblog($actor, $note)
    {
        if (
            !($reblogNote = $this->where([
                'actor_id' => $actor->id,
                'reblog_of_id' => service('uuid')
                    ->fromString($note->id)
                    ->getBytes(),
            ])->first())
        ) {
            $this->reblog($actor, $note);
        } else {
            $this->undoReblog($reblogNote);
        }
    }

    protected function setNoteId($data)
    {
        $uuid4 = service('uuid')->uuid4();
        $data['id'] = $uuid4->toString();
        $data['data']['id'] = $uuid4->getBytes();

        if (!isset($data['data']['uri'])) {
            $actor = model('ActorModel')->getActorById(
                $data['data']['actor_id'],
            );

            $data['data']['uri'] = base_url(
                route_to('note', $actor->username, $uuid4->toString()),
            );
        }

        return $data;
    }
}
