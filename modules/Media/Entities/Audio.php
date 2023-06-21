<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Media\Entities;

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
        $audioMetadata = $getID3->analyze($file->getRealPath());

        $this->attributes['file_mimetype'] = $audioMetadata['mime_type'];
        $this->attributes['file_size'] = $audioMetadata['filesize'];
        $this->attributes['description'] = @$audioMetadata['id3v2']['comments']['comment'][0];
        $this->attributes['file_metadata'] = json_encode([
            'playtime_seconds' => $audioMetadata['playtime_seconds'],
            'avdataoffset'     => $audioMetadata['avdataoffset'],
        ], JSON_INVALID_UTF8_SUBSTITUTE);

        return $this;
    }
}
