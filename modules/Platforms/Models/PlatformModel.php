<?php

declare(strict_types=1);

/**
 * Class PlatformModel Model for platforms table in database
 *
 * @copyright  2024 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Platforms\Models;

use CodeIgniter\Model;
use Modules\Platforms\Entities\Platform;

class PlatformModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'platforms';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var list<string>
     */
    protected $allowedFields = ['podcast_id', 'type', 'slug', 'link_url', 'account_id', 'is_visible'];

    /**
     * @var class-string<Platform>
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
    public function getPlatformsWithData(int $podcastId, string $platformType): array
    {
        $cacheName = "podcast#{$podcastId}_platforms_{$platformType}_withData";
        if (! ($found = cache($cacheName))) {
            $platforms = service('platforms');

            $found = $this->getPlatforms($podcastId, $platformType);
            $platformsData = $platforms->getPlatformsByType($platformType);

            $knownSlugs = [];
            foreach ($found as $podcastPlatform) {
                $knownSlugs[] = $podcastPlatform->slug;
            }

            foreach ($platformsData as $slug => $platform) {
                if (! in_array($slug, $knownSlugs, true)) {
                    $found[] = new Platform([
                        'podcast_id' => $podcastId,
                        'slug'       => $slug,
                        'type'       => $platformType,
                        'label'      => $platform['label'],
                        'home_url'   => $platform['home_url'],
                        'submit_url' => $platform['submit_url'],
                        'link_url'   => '',
                        'account_id' => null,
                        'is_visible' => false,
                    ]);
                }
            }

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * @return Platform[]
     */
    public function getPlatforms(int $podcastId, string $platformType): array
    {
        $cacheName = "podcast#{$podcastId}_platforms_{$platformType}";
        if (! ($found = cache($cacheName))) {
            $platforms = service('platforms');

            /** @var Platform[] $found */
            $found = $this
                ->where('podcast_id', $podcastId)
                ->where('type', $platformType)
                ->orderBy('slug')
                ->findAll();

            foreach ($found as $platform) {
                $platformData = $platforms->findPlatformBySlug($platformType, $platform->slug);

                if ($platformData === null) {
                    // delete platform, it does not correspond to any existing one
                    $this->delete($platform->id);

                    continue;
                }

                $platform->type = $platformType;
                $platform->label = $platformData['label'];
                $platform->home_url = $platformData['home_url'];
                $platform->submit_url = $platformData['submit_url'];
            }

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * @param array<array<string, bool|int|string|null>> $data
     *
     * @return int|false Number of rows inserted or FALSE on failure
     */
    public function savePlatforms(int $podcastId, string $platformType, array $data): int | false
    {
        $this->clearCache($podcastId);

        $platforms = service('platforms');

        $platformsData = $platforms->getPlatformsByType($platformType);

        $this->builder()
            ->whereIn('slug', array_keys($platformsData))
            ->delete();

        if ($data === []) {
            // no rows inserted
            return 0;
        }

        return $this->insertBatch($data);
    }

    public function removePlatform(int $podcastId, string $platformType, string $platformSlug): bool | string
    {
        $this->clearCache($podcastId);

        return $this->builder()
            ->delete([
                'podcast_id' => $podcastId,
                'type'       => $platformType,
                'slug'       => $platformSlug,
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
