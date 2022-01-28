<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities\Media;

use App\Libraries\TranscriptParser;
use CodeIgniter\Files\File;

class Transcript extends BaseMedia
{
    public ?string $json_path = null;

    public ?string $json_url = null;

    protected string $type = 'transcript';

    public function initFileProperties(): void
    {
        parent::initFileProperties();

        if ($this->file_path && $this->file_metadata && array_key_exists('json_path', $this->file_metadata)) {
            helper('media');

            $this->json_path = media_path($this->file_metadata['json_path']);
            $this->json_url = media_base_url($this->file_metadata['json_path']);
        }
    }

    public function setFile(File $file): self
    {
        parent::setFile($file);

        $content = file_get_contents(media_path($this->attributes['file_path']));

        if ($content === false) {
            return $this;
        }

        $metadata = [];
        if ($fileMetadata = lstat((string) $file)) {
            $metadata = $fileMetadata;
        }

        $transcriptParser = new TranscriptParser();
        $jsonFilePath = $this->attributes['file_directory'] . '/' . $this->attributes['file_name'] . '.json';
        if (($transcriptJson = $transcriptParser->loadString($content)->parseSrt()) && file_put_contents(
            media_path($jsonFilePath),
            $transcriptJson
        )) {
            // set metadata (generated json file path)
            $metadata['json_path'] = $jsonFilePath;
        }

        $this->attributes['file_metadata'] = json_encode($metadata, JSON_INVALID_UTF8_IGNORE);

        return $this;
    }

    public function deleteFile(): void
    {
        parent::deleteFile();

        if ($this->json_path) {
            unlink($this->json_path);
        }
    }
}
