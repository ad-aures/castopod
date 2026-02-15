<?php

declare(strict_types=1);

/**
 * Class SoundbiteModel Model for podcasts_soundbites table in database
 *
 * @copyright  2020 Ad Aures
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
     * @var list<string>
     */
    protected $allowedFields = [
        'id',
        'podcast_id',
        'episode_id',
        'title',
        'start_time',
        'duration',
        'type',
        'media_id',
        'metadata',
        'status',
        'logs',
        'created_by',
        'updated_by',
        'job_started_at',
        'job_ended_at',
    ];

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
        ?ConnectionInterface &$db = null,
        ?ValidationInterface $validation = null,
    ) {
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

    public function getVideoClipById(int $videoClipId): ?VideoClip
    {
        $cacheName = "video-clip#{$videoClipId}";
        if (! ($found = cache($cacheName))) {
            $clip = $this->find($videoClipId);

            if (! $clip instanceof BaseClip) {
                return null;
            }

            $found = new VideoClip($clip->toArray());

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
            'type'   => 'video',
            'status' => 'queued',
        ])
            ->orderBy('created_at')
            ->findAll();

        foreach ($found as $key => $videoClip) {
            $found[$key] = new VideoClip($videoClip->toArray());
        }

        return $found;
    }

    public function getRunningVideoClipsCount(): int
    {
        $result = $this->builder()
            ->select('COUNT(*) as `running_count`')
            ->where([
                'type'   => 'video',
                'status' => 'running',
            ])
            ->get()
            ->getResultArray();

        return (int) $result[0]['running_count'];
    }

    public function doesVideoClipExist(VideoClip $videoClip): int | false
    {
        $result = $this->select('id')
            ->builder()
            ->where([
                'podcast_id' => $videoClip->podcast_id,
                'episode_id' => $videoClip->episode_id,
                'start_time' => $videoClip->start_time,
                'duration'   => $videoClip->duration,
            ])
            ->where('JSON_EXTRACT(`metadata`, "$.format")', $videoClip->format)
            ->where('JSON_EXTRACT(`metadata`, "$.theme.name")', $videoClip->theme['name'])
            ->get()
            ->getResultArray();

        if ($result === []) {
            return false;
        }

        return (int) $result[0]['id'];
    }

    public function deleteVideoClip(int $clipId): BaseResult | bool
    {
        $this->clearVideoClipCache($clipId);

        return $this->delete($clipId);
    }

    public function getClipCount(int $podcastId, int $episodeId): int
    {
        return $this
            ->where([
                'podcast_id' => $podcastId,
                'episode_id' => $episodeId,
            ])
            ->countAllResults();
    }

    public function clearVideoClipCache(int $clipId): void
    {
        cache()
            ->delete("video-clip#{$clipId}");
    }

    public function getSoundbiteById(int $soundbiteId): ?Soundbite
    {
        $cacheName = "soundbite#{$soundbiteId}";
        if (! ($found = cache($cacheName))) {
            $clip = $this->find($soundbiteId);

            if (! $clip instanceof BaseClip) {
                return null;
            }

            $found = new Soundbite($clip->toArray());

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
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
                'type'       => 'audio',
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

    public function deleteSoundbite(int $podcastId, int $episodeId, int $clipId): BaseResult | bool
    {
        $this->clearSoundbiteCache($podcastId, $episodeId, $clipId);

        return $this->delete($clipId);
    }

    public function clearSoundbiteCache(int $podcastId, int $episodeId, int $clipId): void
    {
        cache()
            ->delete("podcast#{$podcastId}_episode#{$episodeId}_soundbites");
        cache()
            ->delete("soundbite#{$clipId}");
    }
}
