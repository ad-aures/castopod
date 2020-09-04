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

    protected $allowedFields = [
        'name',
        'home_url',
        'submit_url',
        'iosapp_url',
        'androidapp_url',
        'comment',
        'display_by_default',
        'ios_deeplink',
        'android_deeplink',
        'logo_file_name',
    ];

    protected $returnType = \App\Entities\Platform::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;

    public function getPlatformsWithLinks($podcastId)
    {
        if (!($found = cache("podcast{$podcastId}_platforms"))) {
            $found = $this->select(
                'platforms.*, platform_links.link_url, platform_links.visible'
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

    public function getPodcastPlatformLinks($podcastId)
    {
        if (!($found = cache("podcast{$podcastId}_platformLinks"))) {
            $found = $this->select(
                'platforms.*, platform_links.link_url, platform_links.visible'
            )
                ->join(
                    'platform_links',
                    'platform_links.platform_id = platforms.id'
                )
                ->where('platform_links.podcast_id', $podcastId)
                ->findAll();

            cache()->save("podcast{$podcastId}_platformLinks", $found, DECADE);
        }

        return $found;
    }

    public function savePlatformLinks($podcastId, $platformLinksData)
    {
        cache()->delete("podcast{$podcastId}_platforms");
        cache()->delete("podcast{$podcastId}_platformLinks");

        // Remove already previously set platforms to overwrite them
        $this->db
            ->table('platform_links')
            ->delete(['podcast_id' => $podcastId]);

        // Set platformLinks
        return $this->db
            ->table('platform_links')
            ->insertBatch($platformLinksData);
    }

    public function getPlatformId($platform)
    {
        if (is_numeric($platform)) {
            return (int) $platform;
        }

        $p = $this->where('name', $platform)->first();

        if (!$p) {
            $this->error = lang('Platform.platformNotFound', [$platform]);

            return false;
        }

        return (int) $p->id;
    }

    public function removePlatformLink($podcastId, $platformId)
    {
        cache()->delete("podcast{$podcastId}_platforms");
        cache()->delete("podcast{$podcastId}_platformLinks");

        return $this->db->table('platform_links')->delete([
            'podcast_id' => $podcastId,
            'platform_id' => $platformId,
        ]);
    }
}
