<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\EpisodeComment;
use App\Libraries\CommentObject;
use CodeIgniter\Database\BaseBuilder;
use Michalsn\Uuid\UuidModel;
use Modules\Fediverse\Activities\CreateActivity;
use Modules\Fediverse\Models\ActivityModel;

class EpisodeCommentModel extends UuidModel
{
    /**
     * @var string
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
     * @var string[]
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
     * @var string[]
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

    public function addComment(EpisodeComment $comment, bool $registerActivity = false): string | false
    {
        $this->db->transStart();
        // increment Episode's comments_count

        if (! ($newCommentId = $this->insert($comment, true))) {
            $this->db->transRollback();

            // Couldn't insert comment
            return false;
        }

        if ($comment->in_reply_to_id === null) {
            (new EpisodeModel())
                ->where('id', $comment->episode_id)
                ->increment('comments_count');
        } else {
            (new self())
                ->where('id', service('uuid')->fromString($comment->in_reply_to_id)->getBytes())
                ->increment('replies_count');
        }

        if ($registerActivity) {
            // set post id and uri to construct NoteObject
            $comment->id = $newCommentId;
            $comment->uri = url_to('episode-comment', $comment->actor->username, $comment->episode->slug, $comment->id);

            $createActivity = new CreateActivity();
            $createActivity
                ->set('actor', $comment->actor->uri)
                ->set('object', new CommentObject($comment));

            $activityId = model(ActivityModel::class, false)
                ->newActivity(
                    'Create',
                    $comment->actor_id,
                    null,
                    null,
                    $createActivity->toJSON(),
                    $comment->created_at,
                    'queued',
                );

            $createActivity->set('id', url_to('activity', $comment->actor->username, $activityId));

            model(ActivityModel::class, false)
                ->update($activityId, [
                    'payload' => $createActivity->toJSON(),
                ]);
        }

        $this->db->transComplete();

        return $newCommentId;
    }

    /**
     * Retrieves all published posts for a given episode ordered by publication date
     *
     * @return EpisodeComment[]
     *
     * @noRector ReturnTypeDeclarationRector
     */
    public function getEpisodeComments(int $episodeId): array
    {
        // TODO: merge with replies from posts linked to episode linked
        $episodeComments = $this->select('*, 0 as is_from_post')
            ->where([
                'episode_id' => $episodeId,
                'in_reply_to_id' => null,
            ])
            ->getCompiledSelect();

        $episodePostsReplies = $this->db->table(config('Fediverse')->tablesPrefix . 'posts')
            ->select(
                'id, uri, episode_id, actor_id, in_reply_to_id, message, message_html, favourites_count as likes_count, replies_count, published_at as created_at, created_by, 1 as is_from_post'
            )
            ->whereIn('in_reply_to_id', function (BaseBuilder $builder) use (&$episodeId): BaseBuilder {
                return $builder->select('id')
                    ->from(config('Fediverse')->tablesPrefix . 'posts')
                    ->where('episode_id', $episodeId);
            })
            ->where('`created_at` <= NOW()', null, false)
            ->getCompiledSelect();

        $allEpisodeComments = $this->db->query(
            $episodeComments . ' UNION ' . $episodePostsReplies . ' ORDER BY created_at ASC'
        );

        // FIXME:?
        // @phpstan-ignore-next-line
        return $this->convertUuidFieldsToStrings(
            $allEpisodeComments->getCustomResultObject($this->tempReturnType),
            $this->tempReturnType
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

    /**
     * @param array<string, array<string|int, mixed>> $data
     * @return array<string, array<string|int, mixed>>
     */
    protected function setCommentId(array $data): array
    {
        $uuid4 = $this->uuid->{$this->uuidVersion}();
        $data['data']['id'] = $uuid4->toString();

        if (! isset($data['data']['uri'])) {
            $actor = model(ActorModel::class, false)
                ->getActorById((int) $data['data']['actor_id']);
            $episode = model(EpisodeModel::class, false)
                ->find((int) $data['data']['episode_id']);

            $data['data']['uri'] = url_to('episode-comment', $actor->username, $episode->slug, $uuid4->toString());
        }

        return $data;
    }
}
