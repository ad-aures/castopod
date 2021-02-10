<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity;

class Person extends Entity
{
    /**
     * @var \App\Entities\Image
     */
    protected $image;

    protected $casts = [
        'id' => 'integer',
        'full_name' => 'string',
        'unique_name' => 'string',
        'information_url' => '?string',
        'image_uri' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    /**
     * Saves a picture in `public/media/~person/`
     *
     * @param \CodeIgniter\HTTP\Files\UploadedFile|\CodeIgniter\Files\File $image
     *
     */
    public function setImage($image = null)
    {
        if ($image) {
            helper('media');

            $this->attributes['image_uri'] = save_podcast_media(
                $image,
                '~person',
                $this->attributes['unique_name']
            );
            $this->image = new \App\Entities\Image(
                $this->attributes['image_uri']
            );
            $this->image->saveSizes();
        }

        return $this;
    }

    public function getImage()
    {
        return new \App\Entities\Image($this->attributes['image_uri']);
    }
}
