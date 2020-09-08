<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity;

class Image extends Entity
{
    /**
     * @var string
     */
    protected $original_path;

    /**
     * @var string
     */
    protected $original_url;

    /**
     * @var string
     */
    protected $thumbnail_path;

    /**
     * @var string
     */
    protected $thumbnail_url;

    /**
     * @var string
     */
    protected $medium_path;

    /**
     * @var string
     */
    protected $medium_url;

    /**
     * @var string
     */
    protected $large_path;

    /**
     * @var string
     */
    protected $large_url;

    /**
     * @var string
     */
    protected $feed_path;

    /**
     * @var string
     */
    protected $feed_url;

    /**
     * @var string
     */
    protected $id3_path;

    public function __construct($originalUri)
    {
        helper('media');

        $originalPath = media_path($originalUri);

        [
            'filename' => $filename,
            'dirname' => $dirname,
            'extension' => $extension,
        ] = pathinfo($originalPath);

        // load images extensions from config
        $imageConfig = config('Images');
        $thumbnailExtension = $imageConfig->thumbnailExtension;
        $mediumExtension = $imageConfig->mediumExtension;
        $largeExtension = $imageConfig->largeExtension;
        $feedExtension = $imageConfig->feedExtension;
        $id3Extension = $imageConfig->id3Extension;

        $thumbnail =
            $dirname . '/' . $filename . $thumbnailExtension . '.' . $extension;
        $medium =
            $dirname . '/' . $filename . $mediumExtension . '.' . $extension;
        $large =
            $dirname . '/' . $filename . $largeExtension . '.' . $extension;
        $feed = $dirname . '/' . $filename . $feedExtension . '.' . $extension;
        $id3 = $dirname . '/' . $filename . $id3Extension . '.' . $extension;

        parent::__construct([
            'original_path' => $originalPath,
            'original_url' => media_url($originalUri),
            'thumbnail_path' => $thumbnail,
            'thumbnail_url' => base_url($thumbnail),
            'medium_path' => $medium,
            'medium_url' => base_url($medium),
            'large_path' => $large,
            'large_url' => base_url($large),
            'feed_path' => $feed,
            'feed_url' => base_url($feed),
            'id3_path' => $id3,
        ]);
    }

    public function saveSizes()
    {
        // load images sizes from config
        $imageConfig = config('Images');
        $thumbnailSize = $imageConfig->thumbnailSize;
        $mediumSize = $imageConfig->mediumSize;
        $largeSize = $imageConfig->largeSize;
        $feedSize = $imageConfig->feedSize;
        $id3Size = $imageConfig->id3Size;

        $imageService = \Config\Services::image();

        $imageService
            ->withFile($this->attributes['original_path'])
            ->resize($thumbnailSize, $thumbnailSize)
            ->save($this->attributes['thumbnail_path']);

        $imageService
            ->withFile($this->attributes['original_path'])
            ->resize($mediumSize, $mediumSize)
            ->save($this->attributes['medium_path']);

        $imageService
            ->withFile($this->attributes['original_path'])
            ->resize($largeSize, $largeSize)
            ->save($this->attributes['large_path']);

        $imageService
            ->withFile($this->attributes['original_path'])
            ->resize($feedSize, $feedSize)
            ->save($this->attributes['feed_path']);

        $imageService
            ->withFile($this->attributes['original_path'])
            ->resize($id3Size, $id3Size)
            ->save($this->attributes['id3_path']);
    }
}
