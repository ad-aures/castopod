<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities\Clip;

use App\Entities\Media\Video;
use App\Models\MediaModel;
use CodeIgniter\Files\File;

/**
 * @property array $theme
 * @property string $format
 */
class VideoClip extends BaseClip
{
    protected string $type = 'video';

    /**
     * @param array<string, mixed>|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);

        if ($this->metadata !== null && $this->metadata !== []) {
            $this->theme = $this->metadata['theme'];
            $this->format = $this->metadata['format'];
        }
    }

    /**
     * @param array<string, string> $theme
     */
    public function setTheme(array $theme): self
    {
        // TODO: change?
        $this->attributes['metadata'] = json_decode($this->attributes['metadata'] ?? '[]', true);

        $this->attributes['theme'] = $theme;
        $this->attributes['metadata']['theme'] = $theme;

        $this->attributes['metadata'] = json_encode($this->attributes['metadata']);

        return $this;
    }

    public function setFormat(string $format): self
    {
        $this->attributes['metadata'] = json_decode($this->attributes['metadata'], true);

        $this->attributes['format'] = $format;
        $this->attributes['metadata']['format'] = $format;

        $this->attributes['metadata'] = json_encode($this->attributes['metadata']);

        return $this;
    }

    public function setMedia(string $filePath = null): static
    {
        if ($filePath === null) {
            return $this;
        }

        if ($this->attributes['media_id'] !== null) {
            // media is already set, do nothing
            return $this;
        }

        helper('media');
        $file = new File(media_path($filePath));

        $video = new Video([
            'file_path' => $filePath,
            'language_code' => $this->getPodcast()
                ->language_code,
            'uploaded_by' => $this->attributes['created_by'],
            'updated_by' => $this->attributes['created_by'],
        ]);
        $video->setFile($file);

        $this->attributes['media_id'] = (new MediaModel())->saveMedia($video);

        return $this;
    }
}
