<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use ActivityPub\Entities\Note as ActivityPubNote;
use App\Models\ActorModel;
use App\Models\EpisodeModel;
use RuntimeException;

/**
 * @property int|null $episode_id
 * @property Episode|null $episode
 */
class Note extends ActivityPubNote
{
    /**
     * @var Episode|null
     */
    protected $episode;

    protected $casts = [
        'id' => 'string',
        'uri' => 'string',
        'actor_id' => 'integer',
        'in_reply_to_id' => '?string',
        'reblog_of_id' => '?string',
        'episode_id' => '?integer',
        'message' => 'string',
        'message_html' => 'string',
        'favourites_count' => 'integer',
        'reblogs_count' => 'integer',
        'replies_count' => 'integer',
        'created_by' => 'integer',
    ];

    /**
     * Returns the note's attached episode
     *
     * @return \App\Entities\Episode
     */
    public function getEpisode()
    {
        if ($this->episode_id === null) {
            throw new RuntimeException(
                'Note must have an episode_id before getting episode.',
            );
        }

        if ($this->episode === null) {
            $this->episode = (new EpisodeModel())->getEpisodeById(
                $this->episode_id,
            );
        }

        return $this->episode;
    }
}
