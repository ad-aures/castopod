<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Media\Entities;

use CodeIgniter\Files\File;
use Modules\Media\TranscriptParser;

class Transcript extends BaseMedia
{
    public ?string $json_key = null;

    public ?string $json_url = null;

    protected string $type = 'transcript';

    public function __construct(?array $data = null)
    {
        parent::__construct($data);

        if ($this->file_key && $this->file_metadata && array_key_exists('json_key', $this->file_metadata)) {
            helper('media');

            $this->json_key = $this->file_metadata['json_key'];
            $this->json_url = service('file_manager')
                ->getUrl($this->json_key);
        }
    }

    public function setFile(File $file): self
    {
        parent::setFile($file);

        $metadata = lstat((string) $file) ?? [];

        helper('filesystem');

        // set metadata (generated json file path)
        $this->json_key = change_file_path($this->file_key, '', 'json');
        $metadata['json_key'] = $this->json_key;

        $this->attributes['file_metadata'] = json_encode($metadata, JSON_INVALID_UTF8_IGNORE);

        $this->file = $file;

        return $this;
    }

    public function saveFile(): bool
    {
        $this->saveJsonTranscript();

        return parent::saveFile();
    }

    public function deleteFile(): bool
    {
        if (! parent::deleteFile()) {
            return false;
        }

        if ($this->json_key) {
            return service('file_manager')->delete($this->json_key);
        }

        return true;
    }

    private function saveJsonTranscript(): bool
    {
        $srtContent = file_get_contents($this->file->getRealPath());

        $transcriptParser = new TranscriptParser();

        if ($srtContent === false) {
            return false;
        }

        if (! $transcriptJson = $transcriptParser->loadString($srtContent)->parseSrt()) {
            return false;
        }

        $tempFilePath = WRITEPATH . 'uploads/' . $this->file->getRandomName();
        file_put_contents($tempFilePath, $transcriptJson);

        $newTranscriptJson = new File($tempFilePath, true);

        service('file_manager')
            ->save($newTranscriptJson, $this->json_key);

        return true;
    }
}
