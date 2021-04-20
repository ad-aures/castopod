<?php

/**
 * Class SoundbiteModel
 * Model for podcasts_soundbites table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class SoundbiteModel extends Model
{
    protected $table = 'soundbites';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'podcast_id',
        'episode_id',
        'label',
        'start_time',
        'duration',
        'created_by',
        'updated_by',
    ];

    protected $returnType = \App\Entities\Soundbite::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;

    protected $afterInsert = ['clearCache'];
    protected $afterUpdate = ['clearCache'];
    protected $beforeDelete = ['clearCache'];

    public function deleteSoundbite($podcastId, $episodeId, $soundbiteId)
    {
        return $this->delete([
            'podcast_id' => $podcastId,
            'episode_id' => $episodeId,
            'id' => $soundbiteId,
        ]);
    }

    /**
     * Gets all soundbites for an episode
     *
     * @param int $podcastId
     * @param int $episodeId
     *
     * @return \App\Entities\Soundbite[]
     */
    public function getEpisodeSoundbites(int $podcastId, int $episodeId): array
    {
        $cacheName = "podcast_episode#{$episodeId}_soundbites";
        if (!($found = cache($cacheName))) {
            $found = $this->where([
                'episode_id' => $episodeId,
                'podcast_id' => $podcastId,
            ])
                ->orderBy('start_time')
                ->findAll();
            cache()->save($cacheName, $found, DECADE);
        }
        return $found;
    }

    public function clearCache(array $data)
    {
        $episode = (new EpisodeModel())->find(
            isset($data['data'])
                ? $data['data']['episode_id']
                : $data['id']['episode_id'],
        );

        cache()->delete("podcast_episode#{$episode->id}_soundbites");

        // delete cache for rss feed
        cache()->deleteMatching("podcast#{$episode->podcast_id}_feed*");

        cache()->deleteMatching(
            "page_podcast#{$episode->podcast_id}_episode#{$episode->id}_*",
        );

        return $data;
    }
}
