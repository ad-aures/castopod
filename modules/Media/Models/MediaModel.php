<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Media\Models;

use CodeIgniter\Database\BaseResult;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;
use Modules\Media\Entities\Audio;
use Modules\Media\Entities\Chapters;
use Modules\Media\Entities\Document;
use Modules\Media\Entities\Image;
use Modules\Media\Entities\Transcript;
use Modules\Media\Entities\Video;

class MediaModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'media';

    protected $returnType = Document::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * The column used for insert timestamps
     *
     * @var string
     */
    protected $createdField = 'uploaded_at';

    /**
     * @var string[]
     */
    protected $allowedFields = [
        'id',
        'file_key',
        'file_size',
        'file_mimetype',
        'file_metadata',
        'type',
        'description',
        'language_code',
        'uploaded_by',
        'updated_by',
    ];

    /**
     * clear cache before update if by any chance, the podcast name changes, so will the podcast link
     *
     * @var string[]
     */
    protected $beforeUpdate = ['clearCache'];

    /**
     * @var string[]
     */
    protected $beforeDelete = ['clearCache'];

    /**
     * Model constructor.
     *
     * @param ConnectionInterface|null $db         DB Connection
     * @param ValidationInterface|null $validation Validation
     */
    public function __construct(
        protected string $fileType = 'document',
        ConnectionInterface &$db = null,
        ValidationInterface $validation = null
    ) {
        $this->returnType = match ($fileType) {
            'audio'      => Audio::class,
            'video'      => Video::class,
            'image'      => Image::class,
            'transcript' => Transcript::class,
            'chapters'   => Chapters::class,
            default      => Document::class
        };

        parent::__construct($db, $validation);
    }

    public function getMediaById(int $mediaId): mixed
    {
        $cacheName = "media#{$mediaId}";
        if (! ($found = cache($cacheName))) {
            $found = $this->find($mediaId);

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * @param Document|Audio|Video|Image|Transcript|Chapters $media
     */
    public function saveMedia(object $media): int | false
    {
        // save file first
        if (! $media->saveFile()) {
            return false;
        }

        // insert record in database
        if (! $mediaId = $this->insert($media, true)) {
            $this->db->transRollback();

            return false;
        }

        return $mediaId;
    }

    /**
     * @param Document|Audio|Video|Image|Transcript|Chapters $media
     */
    public function updateMedia(object $media): bool
    {
        // save file first
        if (! $media->saveFile()) {
            return false;
        }

        return $this->update($media->id, $media);
    }

    /**
     * @return array<mixed>
     */
    public function getAllOfType(): array
    {
        $result = $this->where('type', $this->fileType)
            ->findAll();
        $mediaClass = $this->returnType;
        foreach ($result as $key => $media) {
            $result[$key] = new $mediaClass($media->toArray(false, true));
        }

        return $result;
    }

    /**
     * @param Document|Audio|Video|Image|Transcript|Chapters $media
     */
    public function deleteMedia($media): bool|BaseResult
    {
        if (! $media->deleteFile()) {
            return false;
        }

        return $this->delete($media->id);
    }

    /**
     * @param mixed[] $data
     *
     * @return mixed[]
     */
    protected function clearCache(array $data): array
    {
        $mediaId = (is_array($data['id']) ? $data['id'][0] : $data['id']);

        cache()
            ->delete("media#{$mediaId}");

        return $data;
    }
}
