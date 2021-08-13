<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use ActivityPub\Activities\CreateActivity;
use App\Entities\Comment;
use App\Libraries\CommentObject;
use CodeIgniter\Database\BaseBuilder;
use Michalsn\Uuid\UuidModel;

class CommentModel extends UuidModel
{
    /**
     * @var string
     */
    protected $returnType = Comment::class;

    /**
     * @var string
     */
    protected $table = 'comments';

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
        'dislikes_count',
        'replies_count',
        'created_at',
        'created_by',
    ];

    /**
     * @var string[]
     */
    protected $beforeInsert = ['setCommentId'];

    public function getCommentById(string $commentId): ?Comment
    {
        $cacheName = "comment#{$commentId}";
        if (! ($found = cache($cacheName))) {
            $found = $this->find($commentId);

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function addComment(Comment $comment, bool $registerActivity = false): string | false
    {
        $this->db->transStart();
        // increment Episode's comments_count

        if (! ($newCommentId = $this->insert($comment, true))) {
            $this->db->transRollback();

            // Couldn't insert comment
            return false;
        }

        (new EpisodeModel())
            ->where('id', $comment->episode_id)
            ->increment('comments_count');

        if ($registerActivity) {
            // set post id and uri to construct NoteObject
            $comment->id = $newCommentId;
            $comment->uri = url_to('comment', $comment->actor->username, $comment->episode->slug, $comment->id);

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

            $createActivity->set('id', url_to('activity', $comment->actor->username, $activityId));

            model('ActivityModel', false)
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
     * @return Comment[]
     */
    public function getEpisodeComments(int $episodeId): array
    {
        // TODO: merge with replies from posts linked to episode linked
        $episodeComments = $this->select('*, 0 as is_from_post')
            ->where('episode_id', $episodeId)
            ->getCompiledSelect();

        $episodePostsReplies = $this->db->table('activitypub_posts')
            ->select(
                'id, uri, episode_id, actor_id, in_reply_to_id, message, message_html, favourites_count as likes_count, 0 as dislikes_count, replies_count, published_at as created_at, created_by, 1 as is_from_post'
            )
            ->whereIn('in_reply_to_id', function (BaseBuilder $builder) use (&$episodeId): BaseBuilder {
                return $builder->select('id')
                    ->from('activitypub_posts')
                    ->where('episode_id', $episodeId);
            })
            ->where('`created_at` <= NOW()', null, false)
            ->getCompiledSelect();

        $allEpisodeComments = $this->db->query(
            $episodeComments . ' UNION ' . $episodePostsReplies . ' ORDER BY created_at ASC'
        );

        return $allEpisodeComments->getCustomResultObject($this->returnType);
    }

    /**
     * Retrieves all replies for a given comment
     *
     * @return Comment[]
     */
    public function getCommentReplies(int $episodeId, string $commentId): array
    {
        // TODO: get all replies for a given comment
        return $this->findAll();
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

            $data['data']['uri'] = url_to('comment', $actor->username, $episode->slug, $uuid4->toString());
        }

        return $data;
    }
}
