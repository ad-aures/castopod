<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Media\Audio;
use App\Entities\Media\Chapters;
use App\Entities\Media\Document;
use App\Entities\Media\Image;
use App\Entities\Media\Transcript;
use App\Entities\Media\Video;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class MediaModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'media';

    /**
     * @var string
     */
    protected $returnType = Document::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = true;

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
        'file_path',
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
        // @phpstan-ignore-next-line
        switch ($fileType) {
            case 'audio':
                $this->returnType = Audio::class;
                break;
            case 'video':
                $this->returnType = Video::class;
                break;
            case 'image':
                $this->returnType = Image::class;
                break;
            case 'transcript':
                $this->returnType = Transcript::class;
                break;
            case 'chapters':
                $this->returnType = Chapters::class;
                break;
            default:
                // do nothing, keep Document class as default
                break;
        }

        parent::__construct($db, $validation);
    }

    public function getMediaById(int $mediaId): Document | Audio | Video | Image | Transcript | Chapters
    {
        $cacheName = "media#{$mediaId}";
        if (! ($found = cache($cacheName))) {
            $builder = $this->where([
                'id' => $mediaId,
            ]);

            $result = $builder->first();
            $mediaClass = $this->returnType;
            $found = new $mediaClass($result->toArray(false, true));

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * @param Document|Audio|Video|Image|Transcript|Chapters $media
     *
     * @noRector ReturnTypeDeclarationRector
     */
    public function saveMedia(object $media): int | false
    {
        // insert record in database
        if (! $mediaId = $this->insert($media, true)) {
            return false;
        }

        return $mediaId;
    }

    /**
     * @param Document|Audio|Video|Image|Transcript|Chapters $media
     *
     * @noRector ReturnTypeDeclarationRector
     */
    public function updateMedia(object $media): bool
    {
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

    public function deleteMedia(object $media): bool
    {
        $media->deleteFile();

        return $this->delete($media->id, true);
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
