<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\PersonModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;
use Modules\Media\Entities\Image;
use Modules\Media\Models\MediaModel;
use RuntimeException;

/**
 * @property int $id
 * @property string $full_name
 * @property string $unique_name
 * @property string|null $information_url
 * @property ?int $avatar_id
 * @property ?Image $avatar
 * @property int $created_by
 * @property int $updated_by
 * @property object[]|null $roles
 */
class Person extends Entity
{
    protected ?Image $avatar = null;

    /**
     * @var object[]|null
     */
    protected ?array $roles = null;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id'              => 'integer',
        'full_name'       => 'string',
        'unique_name'     => 'string',
        'information_url' => '?string',
        'avatar_id'       => '?int',
        'podcast_id'      => '?integer',
        'episode_id'      => '?integer',
        'created_by'      => 'integer',
        'updated_by'      => 'integer',
    ];

    /**
     * Saves the person avatar in `public/media/persons/`
     */
    public function setAvatar(UploadedFile | File|null $file = null): static
    {
        if (! $file instanceof File || ($file instanceof UploadedFile && ! $file->isValid())) {
            return $this;
        }

        if (array_key_exists('avatar_id', $this->attributes) && $this->attributes['avatar_id'] !== null) {
            $this->getAvatar()
                ->setFile($file);
            $this->getAvatar()
                ->updated_by = $this->attributes['updated_by'];
            new MediaModel('image')
                ->updateMedia($this->getAvatar());
        } else {
            $avatar = new Image([
                'file_key' => 'persons/' . $this->attributes['unique_name'] . '.' . $file->getExtension(),
                'sizes'    => config('Images')
                    ->personAvatarSizes,
                'uploaded_by' => $this->attributes['updated_by'],
                'updated_by'  => $this->attributes['updated_by'],
            ]);
            $avatar->setFile($file);

            $this->attributes['avatar_id'] = new MediaModel('image')->saveMedia($avatar);
        }

        return $this;
    }

    public function getAvatar(): ?Image
    {
        if ($this->avatar_id === null) {
            return null;
        }

        if (! $this->avatar instanceof Image) {
            $this->avatar = new MediaModel('image')
                ->getMediaById($this->avatar_id);
        }

        return $this->avatar;
    }

    /**
     * @return object[]
     */
    public function getRoles(): array
    {
        if ($this->attributes['podcast_id'] === null) {
            throw new RuntimeException('Person must have a podcast_id before getting roles.');
        }

        if ($this->roles === null) {
            $this->roles = new PersonModel()
                ->getPersonRoles(
                    $this->id,
                    (int) $this->attributes['podcast_id'],
                    array_key_exists('episode_id', $this->attributes) ? (int) $this->attributes['episode_id'] : null,
                );
        }

        return $this->roles;
    }
}
