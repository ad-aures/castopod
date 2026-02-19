<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Actor;
use App\Entities\Episode;
use App\Entities\EpisodeComment;
use App\Libraries\CommentObject;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\BaseResult;
use CodeIgniter\I18n\Time;
use Michalsn\Uuid\UuidModel;
use Modules\Fediverse\Activities\CreateActivity;
use Modules\Fediverse\Activities\DeleteActivity;
use Modules\Fediverse\Objects\TombstoneObject;

class EpisodeCommentModel extends UuidModel
{
    /**
     * @var class-string<EpisodeComment>
     */
    protected $returnType = EpisodeComment::class;

    /**
     * @var string
     */
    protected $table = 'episode_comments';

    /**
     * @var string[]
     */
    protected $uuidFields = ['id', 'in_reply_to_id'];

    /**
     * @var list<string>
     */
    protected $allowedFields = [
        'id',
        'uri',
        'episode_id',
        'actor_id',
        'in_reply_to_id',
        'message',
        'message_html',
        'likes_count',
        'replies_count',
        'created_at',
        'created_by',
    ];

    /**
     * @var list<string>
     */
    protected $beforeInsert = ['setCommentId'];

    public function getCommentById(string $commentId): ?EpisodeComment
    {
        $cacheName = "comment#{$commentId}";
        if (! ($found = cache($cacheName))) {
            $found = $this->find($commentId);

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function addComment(EpisodeComment $comment, bool $registerActivity = true): bool|int|object|string
    {
        $this->db->transStart();

        if (! ($newCommentId = $this->insert($comment, true))) {
            $this->db->transRollback();

            // Couldn't insert comment
            return false;
        }

        if ($comment->in_reply_to_id === null) {
            new EpisodeModel()
                ->builder()
                ->where('id', $comment->episode_id)
                ->increment('comments_count');
        } else {
            new self()
                ->builder()
                ->where('id', service('uuid')->fromString($comment->in_reply_to_id)->getBytes())
                ->increment('replies_count');
        }

        if ($registerActivity) {
            // set post id and uri to construct NoteObject
            $comment->id = $newCommentId;
            $comment->uri = url_to(
                'episode-comment',
                esc($comment->actor->username),
                $comment->episode->slug,
                $comment->id,
            );

            $createActivity = new CreateActivity();
            $createActivity
                ->set('actor', $comment->actor->uri)
                ->set('object', new CommentObject($comment));

            $activityId = model('ActivityModel', false)
                ->newActivity(
                    'Create',
                    $comment->actor_id,
                    null,
                    null,
                    $createActivity->toJSON(),
                    $comment->created_at,
                    'queued',
                );

            $createActivity->set('id', url_to('activity', esc($comment->actor->username), $activityId));

            model('ActivityModel', false)
                ->update($activityId, [
                    'payload' => $createActivity->toJSON(),
                ]);
        }

        $this->db->transComplete();

        $this->clearCache($comment);

        return $newCommentId;
    }

    public function removeComment(EpisodeComment $comment, bool $registerActivity = true): BaseResult | bool
    {
        $this->db->transStart();

        // remove all replies
        foreach ($comment->replies as $reply) {
            $this->removeComment($reply);
        }

        if ($registerActivity) {
            $deleteActivity = new DeleteActivity();
            $tombstoneObject = new TombstoneObject();
            $tombstoneObject->set('id', $comment->uri);
            $deleteActivity
                ->set('actor', $comment->actor->uri)
                ->set('object', $tombstoneObject);

            $activityId = model('ActivityModel', false)
                ->newActivity(
                    'Delete',
                    $comment->actor_id,
                    null,
                    null,
                    $deleteActivity->toJSON(),
                    Time::now(),
                    'queued',
                );

            $deleteActivity->set('id', url_to('activity', esc($comment->actor->username), $activityId));

            model('ActivityModel', false)
                ->update($activityId, [
                    'payload' => $deleteActivity->toJSON(),
                ]);
        }

        $result = model(self::class, false)
            ->delete($comment->id);

        if ($comment->in_reply_to_id === null) {
            model('EpisodeModel', false)->builder()
                ->where('id', $comment->episode_id)
                ->decrement('comments_count');
        } else {
            new self()
                ->builder()
                ->where('id', service('uuid')->fromString($comment->in_reply_to_id)->getBytes())
                ->decrement('replies_count');
        }

        $this->clearCache($comment);

        $this->db->transComplete();

        return $result;
    }

    /**
     * Retrieves all published posts for a given episode ordered by publication date
     *
     * @return EpisodeComment[]
     */
    public function getEpisodeComments(int $episodeId): array
    {
        // TODO: merge with replies from posts linked to episode linked
        $episodeCommentsBuilder = $this->builder();
        $episodeComments = $episodeCommentsBuilder->select('*, 0 as is_private, 0 as is_from_post')
            ->where([
                'episode_id'     => $episodeId,
                'in_reply_to_id' => null,
            ])
            ->getCompiledSelect();

        $postModel = new PostModel();
        $episodePostsRepliesBuilder = $postModel->builder();
        $episodePostsReplies = $episodePostsRepliesBuilder->select(
            'id, uri, episode_id, actor_id, in_reply_to_id, message, message_html, favourites_count as likes_count, replies_count, published_at as created_at, created_by, is_private, 1 as is_from_post',
        )
            ->whereIn('in_reply_to_id', static function (BaseBuilder $builder) use (&$episodeId): BaseBuilder {
                return $builder->select('id')
                    ->from('fediverse_posts')
                    ->where([
                        'episode_id'     => $episodeId,
                        'in_reply_to_id' => null,
                    ]);
            })
            ->where('`created_at` <= UTC_TIMESTAMP()', null, false);

        // do not get private replies if public
        if (! can_user_interact()) {
            $episodePostsRepliesBuilder->where('is_private', false);
        }

        $episodePostsReplies = $episodePostsRepliesBuilder->getCompiledSelect();

        /** @var BaseResult $allEpisodeComments */
        $allEpisodeComments = $this->db->query(
            $episodeComments . ' UNION ' . $episodePostsReplies . ' ORDER BY created_at ASC',
        );

        return $this->convertUuidFieldsToStrings(
            $allEpisodeComments->getCustomResultObject($this->tempReturnType),
            $this->tempReturnType,
        );
    }

    /**
     * Retrieves all replies for a given comment
     *
     * @return EpisodeComment[]
     */
    public function getCommentReplies(string $commentId): array
    {
        // TODO: get all replies for a given comment
        return $this->where('in_reply_to_id', $this->uuid->fromString($commentId)->getBytes())
            ->orderBy('created_at', 'ASC')
            ->findAll();
    }

    public function resetLikesCount(): int | false
    {
        $commentsLikesCount = $this->db->table('likes')
            ->select('comment_id as id, COUNT(*) as `likes_count`')
            ->groupBy('id')
            ->get()
            ->getResultArray();

        if ($commentsLikesCount !== []) {
            $this->uuidUseBytes = false;
            return $this->updateBatch($commentsLikesCount, 'id');
        }

        return 0;
    }

    public function resetRepliesCount(): int | false
    {
        $commentsRepliesCount = $this->builder()
            ->select('episode_comments.id, COUNT(*) as `replies_count`')
            ->join('episode_comments as c2', 'episode_comments.id = c2.in_reply_to_id')
            ->groupBy('episode_comments.id')
            ->get()
            ->getResultArray();

        if ($commentsRepliesCount !== []) {
            $this->uuidUseBytes = false;
            return $this->updateBatch($commentsRepliesCount, 'id');
        }

        return 0;
    }

    /**
     * @param array<string, array<string|int, mixed>> $data
     * @return array<string, array<string|int, mixed>>
     */
    protected function setCommentId(array $data): array
    {
        $uuid4 = $this->uuid->{$this->uuidVersion}();
        $data['data']['id'] = $uuid4->toString();

        if (! isset($data['data']['uri'])) {
            $actor = model('ActorModel', false)
                ->getActorById((int) $data['data']['actor_id']);
            $episode = model('EpisodeModel', false)
                ->find((int) $data['data']['episode_id']);

            if (! $episode instanceof Episode) {
                return $data;
            }

            if (! $actor instanceof Actor) {
                return $data;
            }

            $data['data']['uri'] = url_to('episode-comment', $actor->username, $episode->slug, $uuid4->toString());
        }

        return $data;
    }

    protected function clearCache(EpisodeComment $comment): void
    {
        cache()
            ->deleteMatching("comment#{$comment->id}*");

        // delete podcast and episode pages cache
        cache()
            ->deleteMatching("podcast-{$comment->episode->podcast->handle}*");
        cache()
            ->deleteMatching('page_podcast#' . $comment->episode->podcast_id . '*');
        cache()
            ->deleteMatching('page_episode#' . $comment->episode_id . '*');
    }
}
