<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities\Media;

use CodeIgniter\Files\File;
use JamesHeinrich\GetID3\GetID3;

/**
 * @property float $duration
 * @property int $header_size
 */
class Audio extends BaseMedia
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
        $audioMetadata = $getID3->analyze(media_path($this->file_path));

        $this->attributes['file_mimetype'] = $audioMetadata['mime_type'];
        $this->attributes['file_size'] = $audioMetadata['filesize'];
        // @phpstan-ignore-next-line
        $this->attributes['description'] = @$audioMetadata['id3v2']['comments']['comment'][0];
        $this->attributes['file_metadata'] = json_encode($audioMetadata, JSON_INVALID_UTF8_SUBSTITUTE);

        return $this;
    }
}
