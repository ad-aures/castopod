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
use Modules\Media\Models\MediaModel;
use Override;
use RuntimeException;

/**
 * @property int $id
 * @property string $file_key
 * @property string $file_url
 * @property string $file_name
 * @property string $file_directory
 * @property string $file_extension
 * @property int $file_size
 * @property string $file_mimetype
 * @property array<mixed>|null $file_metadata
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
     * @var list<string>
     */
    protected $dates = ['uploaded_at', 'updated_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id'            => 'integer',
        'file_key'      => 'string',
        'file_size'     => 'int',
        'file_mimetype' => 'string',
        'file_metadata' => '?json-array',
        'type'          => 'string',
        'description'   => '?string',
        'language_code' => '?string',
        'uploaded_by'   => 'integer',
        'updated_by'    => 'integer',
    ];

    /**
     * @param array<string, mixed> $data
     */
    #[Override]
    public function injectRawData(array $data): static
    {
        parent::injectRawData($data);

        $this->initFileProperties();

        return $this;
    }

    public function initFileProperties(): void
    {
        $pathInfo = pathinfo($this->file_key) + [
            'filename'  => '',
            'dirname'   => '',
            'extension' => '',
        ];

        $this->file_url = service('file_manager')
            ->getUrl($this->file_key);
        $this->file_name = $pathInfo['filename'];
        $this->file_directory = $pathInfo['dirname'];
        $this->file_extension = $pathInfo['extension'];
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

    public function saveFile(): void
    {
        if (! $this->attributes['file'] || ! $this->file_key) {
            throw new RuntimeException("'file' and 'file_key' attributes must be set before saving a file.");
        }

        $this->attributes['file_key'] = service('file_manager')->save($this->attributes['file'], $this->file_key);
    }

    public function deleteFile(): bool
    {
        return service('file_manager')->delete($this->file_key);
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

        if (! service('file_manager')->rename($this->file_key, $newFileKey)) {
            $db->transRollback();

            return false;
        }

        $db->transComplete();

        return true;
    }
}
