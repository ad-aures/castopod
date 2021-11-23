<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Files\File;
use Config\Images;
use RuntimeException;

/**
 * @property File|null $file
 * @property string $dirname
 * @property string $filename
 * @property string $extension
 * @property string $mimetype
 * @property string $path
 * @property string $url
 */
class Image extends Entity
{
    protected Images $config;

    protected File $file;

    protected string $dirname;

    protected string $filename;

    protected string $extension;

    protected string $mimetype;

    /**
     * @var array<string, array<string, int|string>>
     */
    protected array $sizes = [];

    /**
     * @param array<string, array<string, int|string>> $sizes
     * @param File $file
     */
    public function __construct(?File $file, string $path = '', string $mimetype = '', array $sizes = [])
    {
        if ($file === null && $path === '') {
            throw new RuntimeException('File or path must be set to create an Image.');
        }

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

        if ($file === null) {
            helper('media');
            $file = new File(media_path($path));
        }

        $this->file = $file;
        $this->dirname = $dirname;
        $this->filename = $filename;
        $this->extension = $extension;
        $this->mimetype = $mimetype;
        $this->sizes = $sizes;
    }

    public function __get($property)
    {
        // Convert to CamelCase for the method
        $method = 'get' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $property)));

        // if a get* method exists for this property,
        // call that method to get this value.
        // @phpstan-ignore-next-line
        if (method_exists($this, $method)) {
            return $this->{$method}();
        }

        $fileSuffix = '';
        if ($lastUnderscorePosition = strrpos($property, '_')) {
            $fileSuffix = '_' . substr($property, 0, $lastUnderscorePosition);
        }

        $path = '';
        if ($this->dirname !== '.') {
            $path .= $this->dirname . '/';
        }
        $path .= $this->filename . $fileSuffix;

        $extension = '.' . $this->extension;
        $mimetype = $this->mimetype;
        if ($fileSuffix !== '') {
            $sizeName = substr($fileSuffix, 1);
            if (array_key_exists('extension', $this->sizes[$sizeName])) {
                $extension = '.' . $this->sizes[$sizeName]['extension'];
            }
            if (array_key_exists('mimetype', $this->sizes[$sizeName])) {
                $mimetype = $this->sizes[$sizeName]['mimetype'];
            }
        }
        $path .= $extension;

        if (str_ends_with($property, 'mimetype')) {
            return $mimetype;
        }

        if (str_ends_with($property, 'url')) {
            helper('media');

            return media_base_url($path);
        }

        if (str_ends_with($property, 'path')) {
            return $path;
        }
    }

    public function getMimetype(): string
    {
        return $this->mimetype;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    /**
     * @param array<string, array<string, int|string>> $sizes
     */
    public function saveImage(array $sizes, string $dirname, string $filename): void
    {
        helper('media');

        $this->dirname = $dirname;
        $this->filename = $filename;
        $this->sizes = $sizes;

        save_media($this->file, $this->dirname, $this->filename);

        $imageService = service('image');

        foreach ($sizes as $name => $size) {
            $pathProperty = $name . '_path';
            $imageService
                ->withFile(media_path($this->path))
                ->resize($size['width'], $size['height']);
            $imageService->save(media_path($this->{$pathProperty}));
        }
    }

    /**
     * @param array<string, int[]> $sizes
     */
    public function delete(array $sizes): void
    {
        helper('media');

        foreach (array_keys($sizes) as $name) {
            $pathProperty = $name . '_path';
            unlink(media_path($this->{$pathProperty}));
        }
    }
}
