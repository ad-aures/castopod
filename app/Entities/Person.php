<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Libraries\Image;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\Files\File;
use CodeIgniter\Entity\Entity;

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
     *
     * @param UploadedFile|File|null $image
     */
    public function setImage($image = null): self
    {
        if ($image !== null) {
            helper('media');

            $this->attributes['image_mimetype'] = $image->getMimeType();
            $this->attributes['image_path'] = save_media(
                $image,
                'persons',
                $this->attributes['unique_name'],
            );
            $this->image = new Image(
                $this->attributes['image_path'],
                $this->attributes['image_mimetype'],
            );
            $this->image->saveSizes();
        }

        return $this;
    }

    public function getImage(): Image
    {
        return new Image(
            $this->attributes['image_path'],
            $this->attributes['image_mimetype'],
        );
    }
}
