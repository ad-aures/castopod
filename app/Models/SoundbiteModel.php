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

use CodeIgniter\Database\BaseResult;
use App\Entities\Soundbite;
use CodeIgniter\Model;

class SoundbiteModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'soundbites';
    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var string[]
     */
    protected $allowedFields = [
        'podcast_id',
        'episode_id',
        'label',
        'start_time',
        'duration',
        'created_by',
        'updated_by',
    ];

    /**
     * @var string
     */
    protected $returnType = Soundbite::class;
    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * @var string[]
     */
    protected $afterInsert = ['clearCache'];
    /**
     * @var string[]
     */
    protected $afterUpdate = ['clearCache'];
    /**
     * @var string[]
     */
    protected $beforeDelete = ['clearCache'];

    /**
     * @return bool|BaseResult
     */
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
     * @return Soundbite[]
     */
    public function getEpisodeSoundbites(int $podcastId, int $episodeId): array
    {
        $cacheName = "podcast#{$podcastId}_episode#{$episodeId}_soundbites";
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

    /**
     * @return array<string, array<string|int, mixed>>
     */
    public function clearCache(array $data): array
    {
        $episode = (new EpisodeModel())->find(
            isset($data['data'])
                ? $data['data']['episode_id']
                : $data['id']['episode_id'],
        );

        cache()->delete(
            "podcast#{$episode->podcast_id}_episode#{$episode->id}_soundbites",
        );

        // delete cache for rss feed
        cache()->deleteMatching("podcast#{$episode->podcast_id}_feed*");

        cache()->deleteMatching(
            "page_podcast#{$episode->podcast_id}_episode#{$episode->id}_*",
        );

        return $data;
    }
}
