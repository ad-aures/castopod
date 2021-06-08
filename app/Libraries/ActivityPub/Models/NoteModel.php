<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Models;

use ActivityPub\Activities\AnnounceActivity;
use ActivityPub\Activities\CreateActivity;
use ActivityPub\Activities\DeleteActivity;
use ActivityPub\Activities\UndoActivity;
use ActivityPub\Entities\Actor;
use ActivityPub\Entities\Note;
use ActivityPub\Objects\TombstoneObject;
use CodeIgniter\Database\BaseResult;
use CodeIgniter\Database\Query;
use CodeIgniter\Events\Events;
use CodeIgniter\HTTP\URI;
use CodeIgniter\I18n\Time;
use Exception;
use Michalsn\Uuid\UuidModel;

class NoteModel extends UuidModel
{
    /**
     * @var string
     */
    protected $table = 'activitypub_notes';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var string[]
     */
    protected $uuidFields = ['id', 'in_reply_to_id', 'reblog_of_id'];

    /**
     * @var string[]
     */
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

    /**
     * @var string
     */
    protected $returnType = Note::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    protected $updatedField;

    /**
     * @var array<string, string>
     */
    protected $validationRules = [
        'actor_id' => 'required',
        'message_html' => 'required_without[reblog_of_id]|max_length[500]',
    ];

    /**
     * @var string[]
     */
    protected $beforeInsert = ['setNoteId'];

    public function getNoteById(string $noteId): ?Note
    {
        $cacheName = config('ActivityPub')
            ->cachePrefix . "note#{$noteId}";
        if (! ($found = cache($cacheName))) {
            $found = $this->find($noteId);

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getNoteByUri(string $noteUri): ?Note
    {
        $hashedNoteUri = md5($noteUri);
        $cacheName =
            config('ActivityPub')
                ->cachePrefix . "note-{$hashedNoteUri}";
        if (! ($found = cache($cacheName))) {
            $found = $this->where('uri', $noteUri)
                ->first();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * Retrieves all published notes for a given actor ordered by publication date
     *
     * @return Note[]
     */
    public function getActorPublishedNotes(int $actorId): array
    {
        $cacheName =
            config('ActivityPub')
                ->cachePrefix .
            "actor#{$actorId}_published_notes";
        if (! ($found = cache($cacheName))) {
            $found = $this->where([
                'actor_id' => $actorId,
                'in_reply_to_id' => null,
            ])
                ->where('`published_at` <= NOW()', null, false)
                ->orderBy('published_at', 'DESC')
                ->findAll();

            $secondsToNextUnpublishedNote = $this->getSecondsToNextUnpublishedNote($actorId);

            cache()
                ->save($cacheName, $found, $secondsToNextUnpublishedNote ? $secondsToNextUnpublishedNote : DECADE);
        }

        return $found;
    }

    /**
     * Returns the timestamp difference in seconds between the next note to publish and the current timestamp. Returns
     * false if there's no note to publish
     */
    public function getSecondsToNextUnpublishedNote(int $actorId): int | false
    {
        $result = $this->select('TIMESTAMPDIFF(SECOND, NOW(), `published_at`) as timestamp_diff',)
            ->where([
                'actor_id' => $actorId,
            ])
            ->where('`published_at` > NOW()', null, false)
            ->orderBy('published_at', 'asc')
            ->get()
            ->getResultArray();

        return count($result) !== 0
            ? (int) $result[0]['timestamp_diff']
            : false;
    }

    /**
     * Retrieves all published replies for a given note. By default, it does not get replies from blocked actors.
     *
     * @return Note[]
     */
    public function getNoteReplies(string $noteId, bool $withBlocked = false): array
    {
        $cacheName =
            config('ActivityPub')
                ->cachePrefix .
            "note#{$noteId}_replies" .
            ($withBlocked ? '_withBlocked' : '');

        if (! ($found = cache($cacheName))) {
            if (! $withBlocked) {
                $this->select('activitypub_notes.*')
                    ->join('activitypub_actors', 'activitypub_actors.id = activitypub_notes.actor_id', 'inner',)
                    ->where('activitypub_actors.is_blocked', 0);
            }

            $this->where('in_reply_to_id', $this->uuid->fromString($noteId) ->getBytes(),)
                ->where('`published_at` <= NOW()', null, false)
                ->orderBy('published_at', 'ASC');
            $found = $this->findAll();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * Retrieves all published reblogs for a given note
     *
     * @return Note[]
     */
    public function getNoteReblogs(string $noteId): array
    {
        $cacheName =
            config('ActivityPub')
                ->cachePrefix . "note#{$noteId}_reblogs";

        if (! ($found = cache($cacheName))) {
            $found = $this->where('reblog_of_id', $this->uuid->fromString($noteId) ->getBytes(),)
                ->where('`published_at` <= NOW()', null, false)
                ->orderBy('published_at', 'ASC')
                ->findAll();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function addPreviewCard(string $noteId, int $previewCardId): Query | bool
    {
        return $this->db->table('activitypub_notes_preview_cards')
            ->insert([
                'note_id' => $this->uuid->fromString($noteId)
                    ->getBytes(),
                'preview_card_id' => $previewCardId,
            ]);
    }

    /**
     * Adds note in database along preview card if relevant
     *
     * @return string|false returns the new note id if success or false otherwise
     */
    public function addNote(
        Note $note,
        bool $createPreviewCard = true,
        bool $registerActivity = true
    ): string | false {
        helper('activitypub');

        $this->db->transStart();

        if (! ($newNoteId = $this->insert($note, true))) {
            $this->db->transRollback();

            // Couldn't insert note
            return false;
        }

        if ($createPreviewCard) {
            // parse message
            $messageUrls = extract_urls_from_message($note->message);

            if (
                $messageUrls !== [] &&
                ($previewCard = get_or_create_preview_card_from_url(new URI($messageUrls[0]),)) &&
                ! $this->addPreviewCard($newNoteId, $previewCard->id)
            ) {
                $this->db->transRollback();
                // problem when linking note to preview card
                return false;
            }
        }

        model('ActorModel')
            ->where('id', $note->actor_id)
            ->increment('notes_count');

        if ($registerActivity) {
            // set note id and uri to construct NoteObject
            $note->id = $newNoteId;
            $note->uri = base_url(route_to('note', $note->actor->username, $newNoteId));

            $createActivity = new CreateActivity();
            $noteObjectClass = config('ActivityPub')
                ->noteObject;
            $createActivity
                ->set('actor', $note->actor->uri)
                ->set('object', new $noteObjectClass($note));

            $activityId = model('ActivityModel')
                ->newActivity(
                    'Create',
                    $note->actor_id,
                    null,
                    $newNoteId,
                    $createActivity->toJSON(),
                    $note->published_at,
                    'queued',
                );

            $createActivity->set('id', base_url(route_to('activity', $note->actor->username, $activityId),));

            model('ActivityModel')
                ->update($activityId, [
                    'payload' => $createActivity->toJSON(),
                ]);
        }

        Events::trigger('on_note_add', $note);

        $this->clearCache($note);

        $this->db->transComplete();

        return $newNoteId;
    }

    public function editNote(Note $updatedNote): bool
    {
        $this->db->transStart();

        // update note create activity schedule in database
        $scheduledActivity = model('ActivityModel')
            ->where([
                'type' => 'Create',
                'note_id' => $this->uuid
                    ->fromString($updatedNote->id)
                    ->getBytes(),
            ])
            ->first();

        // update published date in payload
        $newPayload = $scheduledActivity->payload;
        $newPayload->object->published = $updatedNote->published_at->format(DATE_W3C);
        model('ActivityModel')
            ->update($scheduledActivity->id, [
                'payload' => json_encode($newPayload, JSON_THROW_ON_ERROR),
                'scheduled_at' => $updatedNote->published_at,
            ]);

        // update note
        $updateResult = $this->update($updatedNote->id, $updatedNote);

        Events::trigger('on_note_edit', $updatedNote);

        $this->clearCache($updatedNote);

        $this->db->transComplete();

        return $updateResult;
    }

    /**
     * Removes a note from the database and decrements meta data
     */
    public function removeNote(Note $note, bool $registerActivity = true): BaseResult | bool
    {
        $this->db->transStart();

        model('ActorModel')
            ->where('id', $note->actor_id)
            ->decrement('notes_count');

        if ($note->is_reply) {
            // Note to remove is a reply
            model('NoteModel')
                ->where('id', $this->uuid->fromString($note->in_reply_to_id) ->getBytes(),)
                ->decrement('replies_count');

            Events::trigger('on_reply_remove', $note);
        }

        // remove all note reblogs
        foreach ($note->reblogs as $reblog) {
            $this->removeNote($reblog);
        }

        // remove all note replies
        foreach ($note->replies as $reply) {
            $this->removeNote($reply);
        }

        // check that preview card is no longer used elsewhere before deleting it
        if (
            $note->preview_card &&
            $this->db
                ->table('activitypub_notes_preview_cards')
                ->where('preview_card_id', $note->preview_card->id)
                ->countAll() <= 1
        ) {
            model('PreviewCardModel')->deletePreviewCard($note->preview_card->id, $note->preview_card->url);
        }

        if ($registerActivity) {
            $deleteActivity = new DeleteActivity();
            $tombstoneObject = new TombstoneObject();
            $tombstoneObject->set('id', $note->uri);
            $deleteActivity
                ->set('actor', $note->actor->uri)
                ->set('object', $tombstoneObject);

            $activityId = model('ActivityModel')
                ->newActivity(
                    'Delete',
                    $note->actor_id,
                    null,
                    null,
                    $deleteActivity->toJSON(),
                    Time::now(),
                    'queued',
                );

            $deleteActivity->set('id', base_url(route_to('activity', $note->actor->username, $activityId),));

            model('ActivityModel')
                ->update($activityId, [
                    'payload' => $deleteActivity->toJSON(),
                ]);
        }

        $result = model('NoteModel', false)
            ->delete($note->id);

        Events::trigger('on_note_remove', $note);

        $this->clearCache($note);

        $this->db->transComplete();

        return $result;
    }

    public function addReply(
        Note $reply,
        bool $createPreviewCard = true,
        bool $registerActivity = true
    ): string | false {
        if (! $reply->in_reply_to_id) {
            throw new Exception('Passed note is not a reply!');
        }

        $this->db->transStart();

        $noteId = $this->addNote($reply, $createPreviewCard, $registerActivity);

        model('NoteModel')
            ->where('id', $this->uuid->fromString($reply->in_reply_to_id) ->getBytes(),)
            ->increment('replies_count');

        Events::trigger('on_note_reply', $reply);

        $this->clearCache($reply);

        $this->db->transComplete();

        return $noteId;
    }

    public function reblog(Actor $actor, Note $note, bool $registerActivity = true): string | false
    {
        $this->db->transStart();

        $reblog = new Note([
            'actor_id' => $actor->id,
            'reblog_of_id' => $note->id,
            'published_at' => Time::now(),
        ]);

        // add reblog
        $reblogId = $this->insert($reblog);

        model('ActorModel')
            ->where('id', $actor->id)
            ->increment('notes_count');

        model('NoteModel')
            ->where('id', $this->uuid->fromString($note->id)->getBytes())
            ->increment('reblogs_count');

        if ($registerActivity) {
            $announceActivity = new AnnounceActivity($reblog);

            $activityId = model('ActivityModel')
                ->newActivity(
                    'Announce',
                    $actor->id,
                    null,
                    $note->id,
                    $announceActivity->toJSON(),
                    $reblog->published_at,
                    'queued',
                );

            $announceActivity->set('id', base_url(route_to('activity', $note->actor->username, $activityId),));

            model('ActivityModel')
                ->update($activityId, [
                    'payload' => $announceActivity->toJSON(),
                ]);
        }

        Events::trigger('on_note_reblog', $actor, $note);

        $this->clearCache($note);

        $this->db->transComplete();

        return $reblogId;
    }

    public function undoReblog(Note $reblogNote, bool $registerActivity = true): BaseResult | bool
    {
        $this->db->transStart();

        model('ActorModel')
            ->where('id', $reblogNote->actor_id)
            ->decrement('notes_count');

        model('NoteModel')
            ->where('id', $this->uuid->fromString($reblogNote->reblog_of_id) ->getBytes(),)
            ->decrement('reblogs_count');

        if ($registerActivity) {
            $undoActivity = new UndoActivity();
            // get like activity
            $activity = model('ActivityModel')
                ->where([
                    'type' => 'Announce',
                    'actor_id' => $reblogNote->actor_id,
                    'note_id' => $this->uuid
                        ->fromString($reblogNote->reblog_of_id)
                        ->getBytes(),
                ])
                ->first();

            $announceActivity = new AnnounceActivity($reblogNote);
            $announceActivity->set(
                'id',
                base_url(route_to('activity', $reblogNote->actor->username, $activity->id,),),
            );

            $undoActivity
                ->set('actor', $reblogNote->actor->uri)
                ->set('object', $announceActivity);

            $activityId = model('ActivityModel')
                ->newActivity(
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
                base_url(route_to('activity', $reblogNote->actor->username, $activityId,),),
            );

            model('ActivityModel')
                ->update($activityId, [
                    'payload' => $undoActivity->toJSON(),
                ]);
        }

        $result = model('NoteModel', false)
            ->delete($reblogNote->id);

        Events::trigger('on_note_undo_reblog', $reblogNote);

        $this->clearCache($reblogNote);

        $this->db->transComplete();

        return $result;
    }

    public function toggleReblog(Actor $actor, Note $note): void
    {
        if (
            ! ($reblogNote = $this->where([
                'actor_id' => $actor->id,
                'reblog_of_id' => $this->uuid
                    ->fromString($note->id)
                    ->getBytes(),
            ])->first())
        ) {
            $this->reblog($actor, $note);
        } else {
            $this->undoReblog($reblogNote);
        }
    }

    public function clearCache(Note $note): void
    {
        $cachePrefix = config('ActivityPub')
            ->cachePrefix;

        $hashedNoteUri = md5($note->uri);

        model('ActorModel')
            ->clearCache($note->actor);
        cache()
            ->deleteMatching($cachePrefix . "note#{$note->id}*");
        cache()
            ->deleteMatching($cachePrefix . "note-{$hashedNoteUri}*");

        if ($note->is_reply) {
            $this->clearCache($note->reply_to_note);
        }

        if ($note->is_reblog) {
            $this->clearCache($note->reblog_of_note);
        }
    }

    /**
     * @param array<string, array<string|int, mixed>> $data
     * @return array<string, array<string|int, mixed>>
     */
    protected function setNoteId(array $data): array
    {
        $uuid4 = $this->uuid->{$this->uuidVersion}();
        $data['data']['id'] = $uuid4->toString();

        if (! isset($data['data']['uri'])) {
            $actor = model('ActorModel')
                ->getActorById($data['data']['actor_id']);

            $data['data']['uri'] = base_url(route_to('note', $actor->username, $uuid4->toString()));
        }

        return $data;
    }
}
