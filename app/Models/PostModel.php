<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Post;
use Modules\Fediverse\Models\PostModel as FediversePostModel;

class PostModel extends FediversePostModel
{
    /**
     * @var string
     */
    protected $returnType = Post::class;

    /**
     * @var string[]
     */
    protected $allowedFields = [
        'id',
        'uri',
        'actor_id',
        'in_reply_to_id',
        'reblog_of_id',
        'episode_id',
        'message',
        'message_html',
        'favourites_count',
        'reblogs_count',
        'replies_count',
        'created_by',
        'published_at',
    ];

    /**
     * Retrieves all published posts for a given episode ordered by publication date
     *
     * @return Post[]
     */
    public function getEpisodePosts(int $episodeId): array
    {
        return $this->where([
            'episode_id' => $episodeId,
        ])
            ->where('in_reply_to_id', null)
            ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
            ->orderBy('published_at', 'DESC')
            ->findAll();
    }

    public function setEpisodeIdForRepliesOfEpisodePosts(): int | false
    {
        // make sure that posts in reply to episode activities have an episode id
        $postsToUpdate = $this->db->table(config('Fediverse')->tablesPrefix . 'posts as p1')
            ->join(config('Fediverse')->tablesPrefix . 'posts as p2', 'p1.id = p2.in_reply_to_id')
            ->select('p2.id, p1.episode_id')
            ->where([
                'p2.in_reply_to_id IS NOT' => null,
                'p2.episode_id'            => null,
                'p1.episode_id IS NOT'     => null,
            ])
            ->get()
            ->getResultArray();

        if ($postsToUpdate !== []) {
            $postModel = new self();
            $postModel->uuidUseBytes = false;
            return $postModel->updateBatch($postsToUpdate, 'id');
        }

        return 0;
    }
}
