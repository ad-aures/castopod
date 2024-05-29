<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Media\Entities;

use CodeIgniter\Files\File;
use Exception;
use Override;

class Chapters extends BaseMedia
{
    protected string $type = 'chapters';

    #[Override]
    public function initFileProperties(): void
    {
        parent::initFileProperties();

        if ($this->file_metadata !== null && array_key_exists('chapter_count', $this->file_metadata)) {
            helper('media');

            $this->chapter_count = $this->file_metadata['chapter_count'];
        }
    }

    #[Override]
    public function setFile(File $file): self
    {
        parent::setFile($file);

        $metadata = lstat((string) $file);

        if (! $metadata) {
            $metadata = [];
        }

        helper('filesystem');

        $metadata['chapter_count'] = $this->countChaptersInJson($file);

        $this->attributes['file_metadata'] = json_encode($metadata, JSON_INVALID_UTF8_IGNORE);

        $this->file = $file;

        return $this;
    }

    private function countChaptersInJson(File $file): Int
    {
        $chapterContent = file_get_contents($file->getRealPath());

        if ($chapterContent === false) {
            throw new Exception('Could not read chapter file at ' . $this->file->getRealPath());
        }

        return substr_count($chapterContent, 'startTime');
    }
}
