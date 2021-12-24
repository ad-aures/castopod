<?php

declare(strict_types=1);

/**
 * Class SoundbiteModel Model for podcasts_soundbites table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Clip\BaseClip;
use App\Entities\Clip\Soundbite;
use App\Entities\Clip\VideoClip;
use CodeIgniter\Database\BaseResult;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class ClipModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'clips';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var string[]
     */
    protected $allowedFields = [
        'id',
        'podcast_id',
        'episode_id',
        'label',
        'start_time',
        'duration',
        'type',
        'media_id',
        'metadata',
        'status',
        'logs',
        'created_by',
        'updated_by',
    ];

    /**
     * @var string
     */
    protected $returnType = BaseClip::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    public function __construct(
        protected string $type = 'audio',
        ConnectionInterface &$db = null,
        ValidationInterface $validation = null
    ) {
        // @phpstan-ignore-next-line
        switch ($type) {
            case 'audio':
                $this->returnType = Soundbite::class;
                break;
            case 'video':
                $this->returnType = VideoClip::class;
                break;
            default:
                // do nothing, keep default class
                break;
        }

        parent::__construct($db, $validation);
    }

    /**
     * Gets all clips for an episode
     *
     * @return Soundbite[]
     */
    public function getEpisodeSoundbites(int $podcastId, int $episodeId): array
    {
        $cacheName = "podcast#{$podcastId}_episode#{$episodeId}_soundbites";
        if (! ($found = cache($cacheName))) {
            $found = $this->where([
                'episode_id' => $episodeId,
                'podcast_id' => $podcastId,
                'type' => 'audio',
            ])
                ->orderBy('start_time')
                ->findAll();

            foreach ($found as $key => $soundbite) {
                $found[$key] = new Soundbite($soundbite->toArray());
            }

            cache()
                ->save($cacheName, $found, DECADE);
        }
        return $found;
    }

    /**
     * Gets all video clips for an episode
     *
     * @return BaseClip[]
     */
    public function getVideoClips(int $podcastId, int $episodeId): array
    {
        $cacheName = "podcast#{$podcastId}_episode#{$episodeId}_video-clips";
        if (! ($found = cache($cacheName))) {
            $found = $this->where([
                'episode_id' => $episodeId,
                'podcast_id' => $podcastId,
                'type' => 'video',
            ])
                ->orderBy('start_time')
                ->findAll();

            foreach ($found as $key => $videoClip) {
                $found[$key] = new VideoClip($videoClip->toArray());
            }

            cache()
                ->save($cacheName, $found, DECADE);
        }
        return $found;
    }

    /**
     * Gets scheduled video clips for an episode
     *
     * @return VideoClip[]
     */
    public function getScheduledVideoClips(): array
    {
        $found = $this->where([
            'type' => 'video',
            'status' => 'queued',
        ])
            ->orderBy('created_at')
            ->findAll();

        foreach ($found as $key => $videoClip) {
            $found[$key] = new VideoClip($videoClip->toArray());
        }

        return $found;
    }

    public function deleteSoundbite(int $podcastId, int $episodeId, int $clipId): BaseResult | bool
    {
        cache()
            ->delete("podcast#{$podcastId}_episode#{$episodeId}_soundbites");

        return $this->delete([
            'podcast_id' => $podcastId,
            'episode_id' => $episodeId,
            'id' => $clipId,
        ]);
    }

    //     cache()
    //         ->deleteMatching("page_podcast#{$clip->podcast_id}_episode#{$clip->episode_id}_*");
}
