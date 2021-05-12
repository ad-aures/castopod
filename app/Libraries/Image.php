<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

class Image
{
    /**
     * @var \Config\Images
     */
    protected $config;

    /**
     * @var string
     */
    protected $original_path;

    /**
     * @var string
     */
    public $original_url;

    /**
     * @var string
     */
    protected $thumbnail_path;

    /**
     * @var string
     */
    public $thumbnail_url;

    /**
     * @var string
     */
    protected $medium_path;

    /**
     * @var string
     */
    public $medium_url;

    /**
     * @var string
     */
    protected $large_path;

    /**
     * @var string
     */
    public $large_url;

    /**
     * @var string
     */
    public $feed_path;

    /**
     * @var string
     */
    public $feed_url;

    /**
     * @var string
     */
    public $id3_path;

    public function __construct($originalPath, $mimetype)
    {
        helper('media');

        $originalMediaPath = media_path($originalPath);

        [
            'filename' => $filename,
            'dirname' => $dirname,
            'extension' => $extension,
        ] = pathinfo($originalMediaPath);

        // load images extensions from config
        $this->config = config('Images');

        $thumbnailExtension = $this->config->thumbnailExtension;
        $mediumExtension = $this->config->mediumExtension;
        $largeExtension = $this->config->largeExtension;
        $feedExtension = $this->config->feedExtension;
        $id3Extension = $this->config->id3Extension;

        $thumbnail =
            $dirname . '/' . $filename . $thumbnailExtension . '.' . $extension;
        $medium =
            $dirname . '/' . $filename . $mediumExtension . '.' . $extension;
        $large =
            $dirname . '/' . $filename . $largeExtension . '.' . $extension;
        $feed = $dirname . '/' . $filename . $feedExtension . '.' . $extension;
        $id3 = $dirname . '/' . $filename . $id3Extension . '.' . $extension;

        $this->original_path = $originalMediaPath;
        $this->original_url = media_url($originalPath);
        $this->thumbnail_path = $thumbnail;
        $this->thumbnail_url = base_url($thumbnail);
        $this->medium_path = $medium;
        $this->medium_url = base_url($medium);
        $this->large_path = $large;
        $this->large_url = base_url($large);
        $this->feed_path = $feed;
        $this->feed_url = base_url($feed);
        $this->id3_path = $id3;

        $this->mimetype = $mimetype;
    }

    public function saveSizes()
    {
        $thumbnailSize = $this->config->thumbnailSize;
        $mediumSize = $this->config->mediumSize;
        $largeSize = $this->config->largeSize;
        $feedSize = $this->config->feedSize;
        $id3Size = $this->config->id3Size;

        $imageService = \Config\Services::image();

        $imageService
            ->withFile($this->original_path)
            ->resize($thumbnailSize, $thumbnailSize)
            ->save($this->thumbnail_path);

        $imageService
            ->withFile($this->original_path)
            ->resize($mediumSize, $mediumSize)
            ->save($this->medium_path);

        $imageService
            ->withFile($this->original_path)
            ->resize($largeSize, $largeSize)
            ->save($this->large_path);

        $imageService
            ->withFile($this->original_path)
            ->resize($feedSize, $feedSize)
            ->save($this->feed_path);

        $imageService
            ->withFile($this->original_path)
            ->resize($id3Size, $id3Size)
            ->save($this->id3_path);
    }
}
