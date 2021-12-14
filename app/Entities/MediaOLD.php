<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Files\File;

/**
 * @property int $id
 * @property string $file_path
 * @property string $file_directory
 * @property string $file_extension
 * @property string $file_name
 * @property int $file_size
 * @property string $file_content_type
 * @property array $file_metadata
 * @property 'image'|'audio'|'video'|'document' $type
 * @property string $description
 * @property string|null $language_code
 * @property int $uploaded_by
 * @property int $updated_by
 */
class Media extends Entity
{
    protected File $file;

    /**
     * @var string[]
     */
    protected $dates = ['uploaded_at', 'updated_at', 'deleted_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'file_path' => 'string',
        'file_size' => 'string',
        'file_content_type' => 'string',
        'file_metadata' => 'json-array',
        'type' => 'string',
        'description' => 'string',
        'language_code' => '?string',
        'uploaded_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function setFilePath(string $path): self
    {
        $this->attributes['file_path'] = $path;

        [
            'filename' => $filename,
            'dirname' => $dirname,
            'extension' => $extension,
        ] = pathinfo($path);

        $this->file_name = $filename;
        $this->file_directory = $dirname;
        $this->file_extension = $extension;

        return $this;
    }

    public function saveInDisk(File $file, string $dirname, string $filename): void
    {
        helper('media');

        $this->file_content_type = $file->getMimeType();

        $filePath = save_media($file, $dirname, $filename);

        $this->file_path = $filePath;
    }

    public function injectFileData(File $file): void
    {
        $this->file_content_type = $file->getMimeType();
        $this->type = 'document';

        if ($filesize = filesize(media_path($this->file_path))) {
            $this->file_size = $filesize;
        }
    }
}
