<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use ActivityPub\Models\StatusModel as ActivityPubStatusModel;
use App\Entities\Status;

class StatusModel extends ActivityPubStatusModel
{
    /**
     * @var string
     */
    protected $returnType = Status::class;

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
     * Retrieves all published statuses for a given episode ordered by publication date
     *
     * @return Status[]
     */
    public function getEpisodeStatuses(int $episodeId): array
    {
        return $this->where([
            'episode_id' => $episodeId,
        ])
            ->where('`published_at` <= NOW()', null, false)
            ->orderBy('published_at', 'DESC')
            ->findAll();
    }
}
