<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\PersonModel;
use CodeIgniter\Entity\Entity;
use RuntimeException;

/**
 * @property int $id
 * @property string $full_name
 * @property string $unique_name
 * @property string|null $information_url
 * @property Image $avatar
 * @property string $avatar_path
 * @property string $avatar_mimetype
 * @property int $created_by
 * @property int $updated_by
 * @property object[]|null $roles
 */
class Person extends Entity
{
    protected Image $avatar;

    protected ?int $podcast_id = null;

    protected ?int $episode_id = null;

    /**
     * @var object[]|null
     */
    protected ?array $roles = null;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'full_name' => 'string',
        'unique_name' => 'string',
        'information_url' => '?string',
        'avatar_path' => '?string',
        'avatar_mimetype' => '?string',
        'podcast_id' => '?integer',
        'episode_id' => '?integer',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    /**
     * Saves the person avatar in `public/media/persons/`
     */
    public function setAvatar(?Image $avatar = null): static
    {
        if ($avatar === null) {
            return $this;
        }

        helper('media');

        $avatar->saveImage(config('Images')->personAvatarSizes, 'persons', $this->attributes['unique_name']);

        $this->attributes['avatar_mimetype'] = $avatar->mimetype;
        $this->attributes['avatar_path'] = $avatar->path;

        return $this;
    }

    public function getAvatar(): Image
    {
        if ($this->attributes['avatar_path'] === null) {
            return new Image(null, '/castopod-avatar-default.jpg', 'image/jpeg', config('Images')->personAvatarSizes);
        }

        return new Image(null, $this->attributes['avatar_path'], $this->attributes['avatar_mimetype'], config(
            'Images'
        )->personAvatarSizes);
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
            $this->roles = (new PersonModel())->getPersonRoles(
                $this->id,
                (int) $this->attributes['podcast_id'],
                array_key_exists('episode_id', $this->attributes) ? (int) $this->attributes['episode_id'] : null
            );
        }

        return $this->roles;
    }
}
