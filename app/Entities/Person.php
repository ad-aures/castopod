<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int $id
 * @property string $full_name
 * @property string $unique_name
 * @property string|null $information_url
 * @property Image $image
 * @property string $image_path
 * @property string $image_mimetype
 * @property int $created_by
 * @property int $updated_by
 */
class Person extends Entity
{
    /**
     * @var Image
     */
    protected $image;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'full_name' => 'string',
        'unique_name' => 'string',
        'information_url' => '?string',
        'image_path' => 'string',
        'image_mimetype' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    /**
     * Saves a picture in `public/media/persons/`
     */
    public function setImage(Image $image): self
    {
        helper('media');

        // Save image
        $image->saveImage('persons', $this->attributes['unique_name']);

        $this->attributes['image_mimetype'] = $image->mimetype;
        $this->attributes['image_path'] = $image->path;

        return $this;
    }

    public function getImage(): Image
    {
        return new Image(
            null,
            $this->attributes['image_path'],
            $this->attributes['image_mimetype'],
        );
    }
}
