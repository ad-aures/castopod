<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Files\File;
use JamesHeinrich\GetID3\GetID3;

/**
 * @property float $duration
 * @property int $header_size
 */
class Audio extends Media
{
    protected string $type = 'audio';

    /**
     * @param array<string, mixed>|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);

        if ($this->file_metadata) {
            $this->duration = (float) $this->file_metadata['playtime_seconds'];
            $this->header_size = (int) $this->file_metadata['avdataoffset'];
        }
    }

    public function setFile(File $file): self
    {
        parent::setFile($file);

        $getID3 = new GetID3();
        $audioMetadata = $getID3->analyze((string) $file);

        $this->attributes['file_content_type'] = $audioMetadata['mimetype'];
        $this->attributes['file_size'] = $audioMetadata['filesize'];
        $this->attributes['description'] = $audioMetadata['comments']['comment'];
        $this->attributes['file_metadata'] = $audioMetadata;

        return $this;
    }
}
