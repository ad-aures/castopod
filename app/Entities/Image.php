<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Files\File;
use Config\Images as ImagesConfig;
use Config\Services;
use RuntimeException;

/**
 * @property File|null $file
 * @property string $dirname
 * @property string $filename
 * @property string $extension
 * @property string $mimetype
 * @property string $path
 * @property string $url
 * @property string $thumbnail_path
 * @property string $thumbnail_url
 * @property string $medium_path
 * @property string $medium_url
 * @property string $large_path
 * @property string $large_url
 * @property string $feed_path
 * @property string $feed_url
 * @property string $id3_path
 * @property string $id3_url
 */
class Image extends Entity
{
    /**
     * @var ImagesConfig
     */
    protected $config;

    /**
     * @var null|File
     */
    protected $file;

    /**
     * @var string
     */
    protected $dirname;

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var string
     */
    protected $extension;

    public function __construct(
        ?File $file,
        string $path = '',
        string $mimetype = ''
    ) {
        if ($file === null && $path === '') {
            throw new RuntimeException(
                'File or path must be set to create an Image.',
            );
        }

        $this->config = config('Images');

        $dirname = '';
        $filename = '';
        $extension = '';

        if ($file !== null) {
            $dirname = $file->getPath();
            $filename = $file->getBasename();
            $extension = $file->getExtension();
            $mimetype = $file->getMimeType();
        }

        if ($path !== '') {
            [
                'filename' => $filename,
                'dirname' => $dirname,
                'extension' => $extension,
            ] = pathinfo($path);
        }

        $this->file = $file;
        $this->dirname = $dirname;
        $this->filename = $filename;
        $this->extension = $extension;
        $this->mimetype = $mimetype;
    }

    function getFile(): File
    {
        if ($this->file === null) {
            $this->file = new File($this->path);
        }

        return $this->file;
    }

    function getPath(): string
    {
        return $this->dirname . '/' . $this->filename . '.' . $this->extension;
    }

    function getUrl(): string
    {
        helper('media');

        return media_base_url($this->path);
    }

    function getThumbnailPath(): string
    {
        return $this->dirname .
            '/' .
            $this->filename .
            $this->config->thumbnailSuffix .
            '.' .
            $this->extension;
    }

    function getThumbnailUrl(): string
    {
        helper('media');

        return media_base_url($this->thumbnail_path);
    }

    function getMediumPath(): string
    {
        return $this->dirname .
            '/' .
            $this->filename .
            $this->config->mediumSuffix .
            '.' .
            $this->extension;
    }

    function getMediumUrl(): string
    {
        helper('media');

        return media_base_url($this->medium_path);
    }

    function getLargePath(): string
    {
        return $this->dirname .
            '/' .
            $this->filename .
            $this->config->largeSuffix .
            '.' .
            $this->extension;
    }

    function getLargeUrl(): string
    {
        helper('media');

        return media_base_url($this->large_path);
    }

    function getFeedPath(): string
    {
        return $this->dirname .
            '/' .
            $this->filename .
            $this->config->feedSuffix .
            '.' .
            $this->extension;
    }

    function getFeedUrl(): string
    {
        helper('media');

        return media_base_url($this->feed_path);
    }

    function getId3Path(): string
    {
        return $this->dirname .
            '/' .
            $this->filename .
            $this->config->id3Suffix .
            '.' .
            $this->extension;
    }

    function getId3Url(): string
    {
        helper('media');

        return media_base_url($this->id3_path);
    }

    public function saveImage(string $dirname, string $filename): void
    {
        helper('media');

        $this->dirname = $dirname;
        $this->filename = $filename;

        save_media($this->file, $this->dirname, $this->filename);

        $imageService = Services::image();

        $thumbnailSize = $this->config->thumbnailSize;
        $mediumSize = $this->config->mediumSize;
        $largeSize = $this->config->largeSize;
        $feedSize = $this->config->feedSize;
        $id3Size = $this->config->id3Size;

        $imageService
            ->withFile(media_path($this->path))
            ->resize($thumbnailSize, $thumbnailSize)
            ->save(media_path($this->thumbnail_path));

        $imageService
            ->withFile(media_path($this->path))
            ->resize($mediumSize, $mediumSize)
            ->save(media_path($this->medium_path));

        $imageService
            ->withFile(media_path($this->path))
            ->resize($largeSize, $largeSize)
            ->save(media_path($this->large_path));

        $imageService
            ->withFile(media_path($this->path))
            ->resize($feedSize, $feedSize)
            ->save(media_path($this->feed_path));

        $imageService
            ->withFile(media_path($this->path))
            ->resize($id3Size, $id3Size)
            ->save(media_path($this->id3_path));
    }
}
