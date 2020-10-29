<?php

/**
 * Class PlatformModel
 * Model for platforms table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class PlatformModel extends Model
{
    protected $table = 'platforms';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'label', 'home_url', 'submit_url'];

    protected $returnType = \App\Entities\Platform::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;

    public function getPlatformsWithLinks($podcastId)
    {
        if (!($found = cache("podcast{$podcastId}_platforms"))) {
            $found = $this->select(
                'platforms.*, platform_links.link_url, platform_links.is_visible'
            )
                ->join(
                    'platform_links',
                    "platform_links.platform_id = platforms.id AND platform_links.podcast_id = $podcastId",
                    'left'
                )
                ->findAll();

            cache()->save("podcast{$podcastId}_platforms", $found, DECADE);
        }

        return $found;
    }

    public function getPodcastPlatforms($podcastId)
    {
        if (!($found = cache("podcast{$podcastId}_podcastPlatforms"))) {
            $found = $this->select(
                'platforms.*, platform_links.link_url, platform_links.is_visible'
            )
                ->join(
                    'platform_links',
                    'platform_links.platform_id = platforms.id'
                )
                ->where('platform_links.podcast_id', $podcastId)
                ->findAll();

            cache()->save(
                "podcast{$podcastId}_podcastPlatforms",
                $found,
                DECADE
            );
        }

        return $found;
    }

    public function savePodcastPlatforms($podcastId, $platformLinksData)
    {
        $this->clearCache($podcastId);

        // Remove already previously set platforms to overwrite them
        $this->db
            ->table('platform_links')
            ->delete(['podcast_id' => $podcastId]);

        // Set podcastPlatforms
        return $this->db
            ->table('platform_links')
            ->insertBatch($platformLinksData);
    }

    public function getPlatformId(string $platformName)
    {
        $p = $this->where('name', $platformName)->first();

        if (!$p) {
            $this->error = lang('Platform.platformNotFound', [$platformName]);

            return false;
        }

        return (int) $p->id;
    }

    public function removePodcastPlatform($podcastId, $platformId)
    {
        $this->clearCache($podcastId);

        return $this->db->table('platform_links')->delete([
            'podcast_id' => $podcastId,
            'platform_id' => $platformId,
        ]);
    }

    public function clearCache($podcastId)
    {
        cache()->delete("podcast{$podcastId}_platforms");
        cache()->delete("podcast{$podcastId}_podcastPlatforms");

        // delete localized podcast page cache
        $episodeModel = new EpisodeModel();
        $years = $episodeModel->getYears($podcastId);
        $seasons = $episodeModel->getSeasons($podcastId);
        $supportedLocales = config('App')->supportedLocales;

        foreach ($years as $year) {
            foreach ($supportedLocales as $locale) {
                cache()->delete(
                    "page_podcast{$podcastId}_{$year['year']}_{$locale}"
                );
            }
        }

        foreach ($seasons as $season) {
            foreach ($supportedLocales as $locale) {
                cache()->delete(
                    "page_podcast{$podcastId}_season{$season['season_number']}_{$locale}"
                );
            }
        }
    }
}
