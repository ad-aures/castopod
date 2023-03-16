<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Media\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Files\File;
use Modules\Media\FileManagers\FileManagerInterface;
use Modules\Media\FileManagers\FS;
use Modules\Media\FileManagers\S3;
use Modules\Media\Models\MediaModel;

/**
 * @property int $id
 * @property string $file_key
 * @property string $file_url
 * @property string $file_name
 * @property string $file_directory
 * @property string $file_extension
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
        'file_key' => 'string',
        'file_size' => 'int',
        'file_mimetype' => 'string',
        'file_metadata' => '?json-array',
        'type' => 'string',
        'description' => '?string',
        'language_code' => '?string',
        'uploaded_by' => 'integer',
        'updated_by' => 'integer',
    ];

    protected FileManagerInterface $fileManager;

    /**
     * @param array<string, mixed>|null $data
     * @param 'fs'|'s3'|null $fileManager
     */
    public function __construct(array $data = null, string $fileManager = null)
    {
        parent::__construct($data);

        if ($fileManager !== null) {
            $this->fileManager = match ($fileManager) {
                'fs' => new FS(config('Media')),
                's3' => new S3(config('Media'))
            };
        } else {
            /** @var FileManagerInterface $fileManagerService */
            $fileManagerService = service('file_manager');

            $this->fileManager = $fileManagerService;
        }

        $this->initFileProperties();
    }

    public function initFileProperties(): void
    {
        if ($this->file_key !== '') {
            [
                'filename' => $filename,
                'dirname' => $dirname,
                'extension' => $extension,
            ] = pathinfo($this->file_key);

            $this->attributes['file_url'] = $this->fileManager->getUrl($this->file_key);
            $this->attributes['file_name'] = $filename;
            $this->attributes['file_directory'] = $dirname;
            $this->attributes['file_extension'] = $extension;
        }
    }

    public function setFile(File $file): self
    {
        $this->attributes['type'] = $this->type;
        $this->attributes['file_mimetype'] = $file->getMimeType();
        $this->attributes['file_metadata'] = json_encode(lstat((string) $file), JSON_INVALID_UTF8_IGNORE);

        if ($filesize = $file->getSize()) {
            $this->attributes['file_size'] = $filesize;
        }

        $this->attributes['file'] = $file;

        return $this;
    }

    public function saveFile(): bool
    {
        if (! $this->attributes['file'] || ! $this->file_key) {
            return false;
        }

        $this->attributes['file_key'] = $this->fileManager->save($this->attributes['file'], $this->file_key);

        return true;
    }

    public function deleteFile(): bool
    {
        return $this->fileManager->delete($this->file_key);
    }

    public function rename(): bool
    {
        $newFileKey = $this->file_directory . '/' . (new File(''))->getRandomName() . '.' . $this->file_extension;

        $db = db_connect();
        $db->transStart();

        if (! (new MediaModel())->update($this->id, [
            'file_key' => $newFileKey,
        ])) {
            return false;
        }

        if (! $this->fileManager->rename($this->file_key, $newFileKey)) {
            $db->transRollback();
            return false;
        }

        $db->transComplete();

        return true;
    }
}
