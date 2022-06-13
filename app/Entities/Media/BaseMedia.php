<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities\Media;

use App\Models\MediaModel;
use CodeIgniter\Database\BaseResult;
use CodeIgniter\Entity\Entity;
use CodeIgniter\Files\File;

/**
 * @property int $id
 * @property string $file_path
 * @property string $file_url
 * @property string $file_directory
 * @property string $file_extension
 * @property string $file_name
 * @property int $file_size
 * @property string $file_mimetype
 * @property array|null $file_metadata
 * @property 'image'|'audio'|'video'|'document' $type
 * @property string|null $description
 * @property string|null $language_code
 * @property int $uploaded_by
 * @property int $updated_by
 */
class BaseMedia extends Entity
{
    protected File $file;

    /**
     * @var string[]
     */
    protected $dates = ['uploaded_at', 'updated_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'file_extension' => 'string',
        'file_path' => 'string',
        'file_size' => 'int',
        'file_mimetype' => 'string',
        'file_metadata' => '?json-array',
        'type' => 'string',
        'description' => '?string',
        'language_code' => '?string',
        'uploaded_by' => 'integer',
        'updated_by' => 'integer',
    ];

    /**
     * @param array<string, mixed>|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);

        $this->initFileProperties();
    }

    public function initFileProperties(): void
    {
        if ($this->file_path !== '') {
            helper('media');
            [
                'filename' => $filename,
                'dirname' => $dirname,
                'extension' => $extension,
            ] = pathinfo($this->file_path);

            $this->attributes['file_url'] = media_base_url($this->file_path);
            $this->attributes['file_name'] = $filename;
            $this->attributes['file_directory'] = $dirname;
            $this->attributes['file_extension'] = $extension;
        }
    }

    public function setFile(File $file): self
    {
        helper('media');

        $this->attributes['type'] = $this->type;
        $this->attributes['file_mimetype'] = $file->getMimeType();
        $this->attributes['file_metadata'] = json_encode(lstat((string) $file), JSON_INVALID_UTF8_IGNORE);
        $this->attributes['file_path'] = save_media(
            $file,
            $this->attributes['file_directory'],
            $this->attributes['file_name']
        );
        if ($filesize = filesize(media_path($this->file_path))) {
            $this->attributes['file_size'] = $filesize;
        }

        return $this;
    }

    public function deleteFile(): bool
    {
        helper('media');
        return unlink(media_path($this->file_path));
    }

    public function delete(): bool|BaseResult
    {
        $mediaModel = new MediaModel();
        return $mediaModel->delete($this->id);
    }
}
