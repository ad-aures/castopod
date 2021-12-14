<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Audio;
use App\Entities\Image;
use App\Entities\Media;
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
    protected $returnType = Media::class;

    /**
     * @var string[]
     */
    protected $allowedFields = [
        'id',
        'file_path',
        'file_size',
        'file_content_type',
        'file_metadata',
        'type',
        'description',
        'language_code',
        'uploaded_by',
        'updated_by',
    ];

    /**
     * Model constructor.
     *
     * @param ConnectionInterface|null $db         DB Connection
     * @param ValidationInterface|null $validation Validation
     */
    public function __construct(
        protected string $fileType,
        ConnectionInterface &$db = null,
        ValidationInterface $validation = null
    ) {
        switch ($fileType) {
            case 'audio':
                $this->returnType = Audio::class;
                break;
            case 'image':
                $this->returnType = Image::class;
                break;
            default:
                // do nothing, keep Media class as default
                break;
        }

        parent::__construct($db, $validation);
    }

    /**
     * @return Media|Image|Audio
     */
    public function getMediaById(int $mediaId): object
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
     * @param Media|Image|Audio $media
     */
    public function saveMedia(object $media): int | false
    {
        // insert record in database
        if (! $mediaId = $this->insert($media, true)) {
            return false;
        }

        // @phpstan-ignore-next-line
        return $mediaId;
    }
}
