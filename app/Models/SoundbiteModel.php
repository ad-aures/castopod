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
        if (!($found = cache("episode{$episodeId}_soundbites"))) {
            $found = $this->where([
                'episode_id' => $episodeId,
                'podcast_id' => $podcastId,
            ])
                ->orderBy('start_time')
                ->findAll();
            cache()->save("episode{$episodeId}_soundbites", $found, DECADE);
        }
        return $found;
    }

    public function clearCache(array $data)
    {
        $episode = (new EpisodeModel())->find(
            isset($data['data'])
                ? $data['data']['episode_id']
                : $data['id']['episode_id']
        );

        cache()->delete("episode{$episode->id}_soundbites");

        // delete cache for rss feed
        cache()->delete("podcast{$episode->id}_feed");
        foreach (\Opawg\UserAgentsPhp\UserAgentsRSS::$db as $service) {
            cache()->delete(
                "podcast{$episode->podcast->id}_feed_{$service['slug']}"
            );
        }

        $supportedLocales = config('App')->supportedLocales;
        foreach ($supportedLocales as $locale) {
            cache()->delete(
                "page_podcast{$episode->podcast->id}_episode{$episode->id}_{$locale}"
            );
        }
        return $data;
    }
}
