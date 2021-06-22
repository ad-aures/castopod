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
use ActivityPub\Entities\Status;
use ActivityPub\Objects\TombstoneObject;
use CodeIgniter\Database\BaseResult;
use CodeIgniter\Database\Query;
use CodeIgniter\Events\Events;
use CodeIgniter\HTTP\URI;
use CodeIgniter\I18n\Time;
use Exception;
use Michalsn\Uuid\UuidModel;

class StatusModel extends UuidModel
{
    /**
     * @var string
     */
    protected $table = 'activitypub_statuses';

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
    protected $returnType = Status::class;

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
        'message_html' => 'max_length[500]',
    ];

    /**
     * @var string[]
     */
    protected $beforeInsert = ['setStatusId'];

    public function getStatusById(string $statusId): ?Status
    {
        $cacheName = config('ActivityPub')
            ->cachePrefix . "status#{$statusId}";
        if (! ($found = cache($cacheName))) {
            $found = $this->find($statusId);

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getStatusByUri(string $statusUri): ?Status
    {
        $hashedStatusUri = md5($statusUri);
        $cacheName =
            config('ActivityPub')
                ->cachePrefix . "status-{$hashedStatusUri}";
        if (! ($found = cache($cacheName))) {
            $found = $this->where('uri', $statusUri)
                ->first();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * Retrieves all published statuses for a given actor ordered by publication date
     *
     * @return Status[]
     */
    public function getActorPublishedStatuses(int $actorId): array
    {
        $cacheName =
            config('ActivityPub')
                ->cachePrefix .
            "actor#{$actorId}_published_statuses";
        if (! ($found = cache($cacheName))) {
            $found = $this->where([
                'actor_id' => $actorId,
                'in_reply_to_id' => null,
            ])
                ->where('`published_at` <= NOW()', null, false)
                ->orderBy('published_at', 'DESC')
                ->findAll();

            $secondsToNextUnpublishedStatus = $this->getSecondsToNextUnpublishedStatuses($actorId);

            cache()
                ->save($cacheName, $found, $secondsToNextUnpublishedStatus ? $secondsToNextUnpublishedStatus : DECADE);
        }

        return $found;
    }

    /**
     * Returns the timestamp difference in seconds between the next status to publish and the current timestamp. Returns
     * false if there's no status to publish
     */
    public function getSecondsToNextUnpublishedStatuses(int $actorId): int | false
    {
        $result = $this->select('TIMESTAMPDIFF(SECOND, NOW(), `published_at`) as timestamp_diff')
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
     * Retrieves all published replies for a given status. By default, it does not get replies from blocked actors.
     *
     * @return Status[]
     */
    public function getStatusReplies(string $statusId, bool $withBlocked = false): array
    {
        $cacheName =
            config('ActivityPub')
                ->cachePrefix .
            "status#{$statusId}_replies" .
            ($withBlocked ? '_withBlocked' : '');

        if (! ($found = cache($cacheName))) {
            if (! $withBlocked) {
                $this->select('activitypub_statuses.*')
                    ->join('activitypub_actors', 'activitypub_actors.id = activitypub_statuses.actor_id', 'inner')
                    ->where('activitypub_actors.is_blocked', 0);
            }

            $this->where('in_reply_to_id', $this->uuid->fromString($statusId) ->getBytes())
                ->where('`published_at` <= NOW()', null, false)
                ->orderBy('published_at', 'ASC');
            $found = $this->findAll();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * Retrieves all published reblogs for a given status
     *
     * @return Status[]
     */
    public function getStatusReblogs(string $statusId): array
    {
        $cacheName =
            config('ActivityPub')
                ->cachePrefix . "status#{$statusId}_reblogs";

        if (! ($found = cache($cacheName))) {
            $found = $this->where('reblog_of_id', $this->uuid->fromString($statusId) ->getBytes())
                ->where('`published_at` <= NOW()', null, false)
                ->orderBy('published_at', 'ASC')
                ->findAll();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function addPreviewCard(string $statusId, int $previewCardId): Query | bool
    {
        return $this->db->table('activitypub_statuses_preview_cards')
            ->insert([
                'status_id' => $this->uuid->fromString($statusId)
                    ->getBytes(),
                'preview_card_id' => $previewCardId,
            ]);
    }

    /**
     * Adds status in database along preview card if relevant
     *
     * @return string|false returns the new status id if success or false otherwise
     */
    public function addStatus(
        Status $status,
        bool $createPreviewCard = true,
        bool $registerActivity = true
    ): string | false {
        helper('activitypub');

        $this->db->transStart();

        if (! ($newStatusId = $this->insert($status, true))) {
            $this->db->transRollback();

            // Couldn't insert status
            return false;
        }

        if ($createPreviewCard) {
            // parse message
            $messageUrls = extract_urls_from_message($status->message);

            if (
                $messageUrls !== [] &&
                ($previewCard = get_or_create_preview_card_from_url(new URI($messageUrls[0]))) &&
                ! $this->addPreviewCard($newStatusId, $previewCard->id)
            ) {
                $this->db->transRollback();
                // problem when linking status to preview card
                return false;
            }
        }

        model('ActorModel')
            ->where('id', $status->actor_id)
            ->increment('statuses_count');

        if ($registerActivity) {
            // set status id and uri to construct NoteObject
            $status->id = $newStatusId;
            $status->uri = base_url(route_to('status', $status->actor->username, $newStatusId));

            $createActivity = new CreateActivity();
            $noteObjectClass = config('ActivityPub')
                ->noteObject;
            $createActivity
                ->set('actor', $status->actor->uri)
                ->set('object', new $noteObjectClass($status));

            $activityId = model('ActivityModel')
                ->newActivity(
                    'Create',
                    $status->actor_id,
                    null,
                    $newStatusId,
                    $createActivity->toJSON(),
                    $status->published_at,
                    'queued',
                );

            $createActivity->set('id', base_url(route_to('activity', $status->actor->username, $activityId)));

            model('ActivityModel')
                ->update($activityId, [
                    'payload' => $createActivity->toJSON(),
                ]);
        }

        Events::trigger('on_status_add', $status);

        $this->clearCache($status);

        $this->db->transComplete();

        return $newStatusId;
    }

    public function editStatus(Status $updatedStatus): bool
    {
        $this->db->transStart();

        // update status create activity schedule in database
        $scheduledActivity = model('ActivityModel')
            ->where([
                'type' => 'Create',
                'status_id' => $this->uuid
                    ->fromString($updatedStatus->id)
                    ->getBytes(),
            ])
            ->first();

        // update published date in payload
        $newPayload = $scheduledActivity->payload;
        $newPayload->object->published = $updatedStatus->published_at->format(DATE_W3C);
        model('ActivityModel')
            ->update($scheduledActivity->id, [
                'payload' => json_encode($newPayload, JSON_THROW_ON_ERROR),
                'scheduled_at' => $updatedStatus->published_at,
            ]);

        // update status
        $updateResult = $this->update($updatedStatus->id, $updatedStatus);

        Events::trigger('on_status_edit', $updatedStatus);

        $this->clearCache($updatedStatus);

        $this->db->transComplete();

        return $updateResult;
    }

    /**
     * Removes a status from the database and decrements meta data
     */
    public function removeStatus(Status $status, bool $registerActivity = true): BaseResult | bool
    {
        $this->db->transStart();

        model('ActorModel')
            ->where('id', $status->actor_id)
            ->decrement('statuses_count');

        if ($status->in_reply_to_id !== null) {
            // Status to remove is a reply
            model('StatusModel')
                ->where('id', $this->uuid->fromString($status->in_reply_to_id) ->getBytes())
                ->decrement('replies_count');

            Events::trigger('on_reply_remove', $status);
        }

        // remove all status reblogs
        foreach ($status->reblogs as $reblog) {
            // FIXME: issue when actor is not local, can't get actor information
            $this->removeStatus($reblog);
        }

        // remove all status replies
        foreach ($status->replies as $reply) {
            $this->removeStatus($reply);
        }

        // check that preview card is no longer used elsewhere before deleting it
        if (
            $status->preview_card &&
            $this->db
                ->table('activitypub_statuses_preview_cards')
                ->where('preview_card_id', $status->preview_card->id)
                ->countAll() <= 1
        ) {
            model('PreviewCardModel')->deletePreviewCard($status->preview_card->id, $status->preview_card->url);
        }

        if ($registerActivity) {
            $deleteActivity = new DeleteActivity();
            $tombstoneObject = new TombstoneObject();
            $tombstoneObject->set('id', $status->uri);
            $deleteActivity
                ->set('actor', $status->actor->uri)
                ->set('object', $tombstoneObject);

            $activityId = model('ActivityModel')
                ->newActivity(
                    'Delete',
                    $status->actor_id,
                    null,
                    null,
                    $deleteActivity->toJSON(),
                    Time::now(),
                    'queued',
                );

            $deleteActivity->set('id', base_url(route_to('activity', $status->actor->username, $activityId)));

            model('ActivityModel')
                ->update($activityId, [
                    'payload' => $deleteActivity->toJSON(),
                ]);
        }

        $result = model('StatusModel', false)
            ->delete($status->id);

        Events::trigger('on_status_remove', $status);

        $this->clearCache($status);

        $this->db->transComplete();

        return $result;
    }

    public function addReply(
        Status $reply,
        bool $createPreviewCard = true,
        bool $registerActivity = true
    ): string | false {
        if (! $reply->in_reply_to_id) {
            throw new Exception('Passed status is not a reply!');
        }

        $this->db->transStart();

        $statusId = $this->addStatus($reply, $createPreviewCard, $registerActivity);

        model('StatusModel')
            ->where('id', $this->uuid->fromString($reply->in_reply_to_id) ->getBytes())
            ->increment('replies_count');

        Events::trigger('on_status_reply', $reply);

        $this->clearCache($reply);

        $this->db->transComplete();

        return $statusId;
    }

    public function reblog(Actor $actor, Status $status, bool $registerActivity = true): string | false
    {
        $this->db->transStart();

        $reblog = new Status([
            'actor_id' => $actor->id,
            'reblog_of_id' => $status->id,
            'published_at' => Time::now(),
        ]);

        // add reblog
        $reblogId = $this->insert($reblog);

        model('ActorModel')
            ->where('id', $actor->id)
            ->increment('statuses_count');

        model('StatusModel')
            ->where('id', $this->uuid->fromString($status->id)->getBytes())
            ->increment('reblogs_count');

        if ($registerActivity) {
            $announceActivity = new AnnounceActivity($reblog);

            $activityId = model('ActivityModel')
                ->newActivity(
                    'Announce',
                    $actor->id,
                    null,
                    $status->id,
                    $announceActivity->toJSON(),
                    $reblog->published_at,
                    'queued',
                );

            $announceActivity->set('id', base_url(route_to('activity', $status->actor->username, $activityId)));

            model('ActivityModel')
                ->update($activityId, [
                    'payload' => $announceActivity->toJSON(),
                ]);
        }

        Events::trigger('on_status_reblog', $actor, $status);

        $this->clearCache($status);

        $this->db->transComplete();

        return $reblogId;
    }

    public function undoReblog(Status $reblogStatus, bool $registerActivity = true): BaseResult | bool
    {
        $this->db->transStart();

        model('ActorModel')
            ->where('id', $reblogStatus->actor_id)
            ->decrement('statuses_count');

        model('StatusModel')
            ->where('id', $this->uuid->fromString($reblogStatus->reblog_of_id) ->getBytes())
            ->decrement('reblogs_count');

        if ($registerActivity) {
            $undoActivity = new UndoActivity();
            // get like activity
            $activity = model('ActivityModel')
                ->where([
                    'type' => 'Announce',
                    'actor_id' => $reblogStatus->actor_id,
                    'status_id' => $this->uuid
                        ->fromString($reblogStatus->reblog_of_id)
                        ->getBytes(),
                ])
                ->first();

            $announceActivity = new AnnounceActivity($reblogStatus);
            $announceActivity->set(
                'id',
                base_url(route_to('activity', $reblogStatus->actor->username, $activity->id)),
            );

            $undoActivity
                ->set('actor', $reblogStatus->actor->uri)
                ->set('object', $announceActivity);

            $activityId = model('ActivityModel')
                ->newActivity(
                    'Undo',
                    $reblogStatus->actor_id,
                    null,
                    $reblogStatus->reblog_of_id,
                    $undoActivity->toJSON(),
                    Time::now(),
                    'queued',
                );

            $undoActivity->set('id', base_url(route_to('activity', $reblogStatus->actor->username, $activityId)));

            model('ActivityModel')
                ->update($activityId, [
                    'payload' => $undoActivity->toJSON(),
                ]);
        }

        $result = model('StatusModel', false)
            ->delete($reblogStatus->id);

        Events::trigger('on_status_undo_reblog', $reblogStatus);

        $this->clearCache($reblogStatus);

        $this->db->transComplete();

        return $result;
    }

    public function toggleReblog(Actor $actor, Status $status): void
    {
        if (
            ! ($reblogStatus = $this->where([
                'actor_id' => $actor->id,
                'reblog_of_id' => $this->uuid
                    ->fromString($status->id)
                    ->getBytes(),
            ])->first())
        ) {
            $this->reblog($actor, $status);
        } else {
            $this->undoReblog($reblogStatus);
        }
    }

    public function clearCache(Status $status): void
    {
        $cachePrefix = config('ActivityPub')
            ->cachePrefix;

        $hashedStatusUri = md5($status->uri);

        model('ActorModel')
            ->clearCache($status->actor);
        cache()
            ->deleteMatching($cachePrefix . "status#{$status->id}*");
        cache()
            ->deleteMatching($cachePrefix . "status-{$hashedStatusUri}*");

        if ($status->in_reply_to_id !== null) {
            $this->clearCache($status->reply_to_status);
        }

        if ($status->reblog_of_id !== null) {
            $this->clearCache($status->reblog_of_status);
        }
    }

    /**
     * @param array<string, array<string|int, mixed>> $data
     * @return array<string, array<string|int, mixed>>
     */
    protected function setStatusId(array $data): array
    {
        $uuid4 = $this->uuid->{$this->uuidVersion}();
        $data['data']['id'] = $uuid4->toString();

        if (! isset($data['data']['uri'])) {
            $actor = model('ActorModel')
                ->getActorById((int) $data['data']['actor_id']);

            $data['data']['uri'] = base_url(route_to('status', $actor->username, $uuid4->toString()));
        }

        return $data;
    }
}
