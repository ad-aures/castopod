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
    protected $primaryKey = 'slug';

    protected $allowedFields = [
        'slug',
        'type',
        'label',
        'home_url',
        'submit_url',
    ];

    protected $returnType = \App\Entities\Platform::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;

    public function getPlatforms()
    {
        if (!($found = cache('platforms'))) {
            $baseUrl = rtrim(config('app')->baseURL, '/');
            $found = $this->select(
                "*, CONCAT('{$baseUrl}/assets/images/platforms/',`type`,'/',`slug`,'.svg') as icon"
            )->findAll();
            cache()->save('platforms', $found, DECADE);
        }
        return $found;
    }

    public function getPlatform($slug)
    {
        if (!($found = cache("platform_$slug"))) {
            $found = $this->where('slug', $slug)->first();
            cache()->save("platform_$slug", $found, DECADE);
        }
        return $found;
    }

    public function createPlatform(
        $slug,
        $type,
        $label,
        $homeUrl,
        $submitUrl = null
    ) {
        $data = [
            'slug' => $slug,
            'type' => $type,
            'label' => $label,
            'home_url' => $homeUrl,
            'submit_url' => $submitUrl,
        ];
        return $this->insert($data, false);
    }

    public function getPlatformsWithLinks($podcastId, $platformType)
    {
        if (
            !($found = cache("podcast{$podcastId}_platforms_{$platformType}"))
        ) {
            $found = $this->select(
                'platforms.*, podcasts_platforms.link_url, podcasts_platforms.link_content, podcasts_platforms.is_visible'
            )
                ->join(
                    'podcasts_platforms',
                    "podcasts_platforms.platform_slug = platforms.slug AND podcasts_platforms.podcast_id = $podcastId",
                    'left'
                )
                ->where('platforms.type', $platformType)
                ->findAll();

            cache()->save(
                "podcast{$podcastId}_platforms_{$platformType}",
                $found,
                DECADE
            );
        }

        return $found;
    }

    public function getPodcastPlatforms($podcastId, $platformType)
    {
        if (
            !($found = cache(
                "podcast{$podcastId}_podcastPlatforms_{$platformType}"
            ))
        ) {
            $found = $this->select(
                'platforms.*, podcasts_platforms.link_url, podcasts_platforms.link_content, podcasts_platforms.is_visible'
            )
                ->join(
                    'podcasts_platforms',
                    'podcasts_platforms.platform_slug = platforms.slug'
                )
                ->where('podcasts_platforms.podcast_id', $podcastId)
                ->where('platforms.type', $platformType)
                ->findAll();

            cache()->save(
                "podcast{$podcastId}_podcastPlatforms_{$platformType}",
                $found,
                DECADE
            );
        }

        return $found;
    }

    public function savePodcastPlatforms(
        $podcastId,
        $platformType,
        $podcastsPlatformsData
    ) {
        $this->clearCache($podcastId);

        $podcastsPlatformsTable = $this->db->prefixTable('podcasts_platforms');
        $platformsTable = $this->db->prefixTable('platforms');
        $deleteJoinQuery = <<<EOD
DELETE $podcastsPlatformsTable
FROM $podcastsPlatformsTable
INNER JOIN $platformsTable ON $platformsTable.slug = $podcastsPlatformsTable.platform_slug
WHERE `podcast_id` = ? AND `type` = ?
EOD;
        $this->db->query($deleteJoinQuery, [$podcastId, $platformType]);

        // Set podcastPlatforms
        return $this->db
            ->table('podcasts_platforms')
            ->insertBatch($podcastsPlatformsData);
    }

    public function createPodcastPlatforms($podcastId, $podcastsPlatformsData)
    {
        $this->clearCache($podcastId);

        // Set podcastPlatforms
        return $this->db
            ->table('podcasts_platforms')
            ->insertBatch($podcastsPlatformsData);
    }

    public function removePodcastPlatform($podcastId, $platformSlug)
    {
        $this->clearCache($podcastId);

        return $this->db->table('podcasts_platforms')->delete([
            'podcast_id' => $podcastId,
            'platform_slug' => $platformSlug,
        ]);
    }

    public function clearCache($podcastId)
    {
        foreach (['podcasting', 'social', 'funding'] as $platformType) {
            cache()->delete("podcast{$podcastId}_platforms_{$platformType}");
            cache()->delete(
                "podcast{$podcastId}_podcastPlatforms_{$platformType}"
            );
        }
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
