<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Entities;

use Michalsn\Uuid\UuidEntity;

class Note extends UuidEntity
{
    protected $uuids = ['id', 'in_reply_to_id', 'reblog_of_id'];

    /**
     * @var \ActivityPub\Entities\Actor
     */
    protected $actor;

    /**
     * @var boolean
     */
    protected $is_reply;

    /**
     * @var \ActivityPub\Entities\Note
     */
    protected $reply_to_note;

    /**
     * @var boolean
     */
    protected $is_reblog;

    /**
     * @var \ActivityPub\Entities\Note
     */
    protected $reblog_of_note;

    /**
     * @var \ActivityPub\Entities\PreviewCard
     */
    protected $preview_card;

    /**
     * @var \ActivityPub\Entities\Note[]
     */
    protected $replies;

    /**
     * @var \ActivityPub\Entities\Note[]
     */
    protected $reblogs;

    protected $dates = ['published_at', 'created_at'];

    protected $casts = [
        'id' => 'string',
        'uri' => 'string',
        'actor_id' => 'integer',
        'in_reply_to_id' => '?string',
        'reblog_of_id' => '?string',
        'message' => 'string',
        'message_html' => 'string',
        'favourites_count' => 'integer',
        'reblogs_count' => 'integer',
        'replies_count' => 'integer',
    ];

    /**
     * Returns the note's actor
     *
     * @return \ActivityPub\Entities\Actor
     */
    public function getActor()
    {
        if (empty($this->actor_id)) {
            throw new \RuntimeException(
                'Note must have an actor_id before getting actor.',
            );
        }

        if (empty($this->actor)) {
            $this->actor = model('ActorModel')->getActorById($this->actor_id);
        }

        return $this->actor;
    }

    public function getPreviewCard()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
                'Note must be created before getting preview_card.',
            );
        }

        if (empty($this->preview_card)) {
            $this->preview_card = model('PreviewCardModel')->getNotePreviewCard(
                $this->id,
            );
        }

        return $this->preview_card;
    }

    public function getReplies()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
                'Note must be created before getting replies.',
            );
        }

        if (empty($this->replies)) {
            $this->replies = model('NoteModel')->getNoteReplies($this->id);
        }

        return $this->replies;
    }

    public function getIsReply()
    {
        $this->is_reply = $this->in_reply_to_id !== null;

        return $this->is_reply;
    }

    public function getReplyToNote()
    {
        if (empty($this->in_reply_to_id)) {
            throw new \RuntimeException('Note is not a reply.');
        }

        if (empty($this->reply_to_note)) {
            $this->reply_to_note = model('NoteModel')->getNoteById(
                $this->in_reply_to_id,
            );
        }

        return $this->reply_to_note;
    }

    public function getReblogs()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
                'Note must be created before getting reblogs.',
            );
        }

        if (empty($this->reblogs)) {
            $this->reblogs = model('NoteModel')->getNoteReblogs(
                service('uuid')
                    ->fromString($this->id)
                    ->getBytes(),
            );
        }

        return $this->reblogs;
    }

    public function getIsReblog()
    {
        return $this->reblog_of_id != null;
    }

    public function getReblogOfNote()
    {
        if (empty($this->reblog_of_id)) {
            throw new \RuntimeException('Note is not a reblog.');
        }

        if (empty($this->reblog_of_note)) {
            $this->reblog_of_note = model('NoteModel')->getNoteById(
                $this->reblog_of_id,
            );
        }

        return $this->reblog_of_note;
    }

    public function setMessage(string $message)
    {
        helper('activitypub');

        $messageWithoutTags = strip_tags($message);

        $this->attributes['message'] = $messageWithoutTags;
        $this->attributes['message_html'] = str_replace(
            "\n",
            '<br />',
            linkify($messageWithoutTags),
        );

        return $this;
    }
}
