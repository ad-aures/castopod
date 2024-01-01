<?php

declare(strict_types=1);

/**
 * Class PlatformModel Model for platforms table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Platform;
use CodeIgniter\Model;
use Config\App;

class PlatformModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'platforms';

    /**
     * @var string
     */
    protected $primaryKey = 'slug';

    /**
     * @var string[]
     */
    protected $allowedFields = ['slug', 'type', 'label', 'home_url', 'submit_url'];

    /**
     * @var string
     */
    protected $returnType = Platform::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = false;

    /**
     * @return Platform[]
     */
    public function getPlatforms(): array
    {
        if (! ($found = cache('platforms'))) {
            $baseUrl = rtrim(config(App::class)->baseURL, '/');
            $found = $this->select(
                "*, CONCAT('{$baseUrl}/assets/images/platforms/',`type`,'/',`slug`,'.svg') as icon",
            )->findAll();
            cache()
                ->save('platforms', $found, DECADE);
        }

        return $found;
    }

    public function getPlatform(string $slug): ?Platform
    {
        $cacheName = "platform-{$slug}";
        if (! ($found = cache($cacheName))) {
            $found = $this->where('slug', $slug)
                ->first();
            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function createPlatform(
        string $slug,
        string $type,
        string $label,
        string $homeUrl,
        string $submitUrl = null
    ): bool {
        $data = [
            'slug'       => $slug,
            'type'       => $type,
            'label'      => $label,
            'home_url'   => $homeUrl,
            'submit_url' => $submitUrl,
        ];

        return $this->insert($data, false);
    }

    /**
     * @return Platform[]
     */
    public function getPlatformsWithLinks(int $podcastId, string $platformType): array
    {
        if (
            ! ($found = cache("podcast#{$podcastId}_platforms_{$platformType}_withLinks"))
        ) {
            $found = $this->select(
                'platforms.*, podcasts_platforms.link_url, podcasts_platforms.account_id, podcasts_platforms.is_visible, podcasts_platforms.is_on_embed',
            )
                ->join(
                    'podcasts_platforms',
                    "podcasts_platforms.platform_slug = platforms.slug AND podcasts_platforms.podcast_id = {$podcastId}",
                    'left',
                )
                ->where('platforms.type', $platformType)
                ->findAll();

            cache()
                ->save("podcast#{$podcastId}_platforms_{$platformType}_withLinks", $found, DECADE);
        }

        return $found;
    }

    /**
     * @return Platform[]
     */
    public function getPodcastPlatforms(int $podcastId, string $platformType): array
    {
        $cacheName = "podcast#{$podcastId}_platforms_{$platformType}";
        if (! ($found = cache($cacheName))) {
            $found = $this->select(
                'platforms.*, podcasts_platforms.link_url, podcasts_platforms.account_id, podcasts_platforms.is_visible, podcasts_platforms.is_on_embed',
            )
                ->join('podcasts_platforms', 'podcasts_platforms.platform_slug = platforms.slug')
                ->where('podcasts_platforms.podcast_id', $podcastId)
                ->where('platforms.type', $platformType)
                ->findAll();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * @param mixed[] $podcastsPlatformsData
     *
     * @return int|false Number of rows inserted or FALSE on failure
     */
    public function savePodcastPlatforms(
        int $podcastId,
        string $platformType,
        array $podcastsPlatformsData
    ): int | false {
        $this->clearCache($podcastId);

        $podcastsPlatformsTable = $this->db->prefixTable('podcasts_platforms');
        $platformsTable = $this->db->prefixTable('platforms');

        $deleteJoinQuery = <<<SQL
        DELETE {$podcastsPlatformsTable}
        FROM {$podcastsPlatformsTable}
        INNER JOIN {$platformsTable} ON {$platformsTable}.slug = {$podcastsPlatformsTable}.platform_slug
        WHERE `podcast_id` = ? AND `type` = ?
        SQL;

        $this->db->query($deleteJoinQuery, [$podcastId, $platformType]);

        if ($podcastsPlatformsData === []) {
            // no rows inserted
            return 0;
        }

        return $this->db
            ->table('podcasts_platforms')
            ->insertBatch($podcastsPlatformsData);
    }

    public function removePodcastPlatform(int $podcastId, string $platformSlug): bool | string
    {
        $this->clearCache($podcastId);

        return $this->db->table('podcasts_platforms')
            ->delete([
                'podcast_id'    => $podcastId,
                'platform_slug' => $platformSlug,
            ]);
    }

    public function clearCache(int $podcastId): void
    {
        cache()->deleteMatching("podcast#{$podcastId}_platforms_*");

        // delete localized podcast page cache
        cache()
            ->deleteMatching("page_podcast#{$podcastId}*");
        // delete post and episode comments pages cache
        cache()
            ->deleteMatching('page_post*');
        cache()
            ->deleteMatching('page_episode#*');
    }
}
