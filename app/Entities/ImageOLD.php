<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Files\File;
use Config\Images;

class Image extends Media
{
    /**
     * @var array<string, array<string, int|string>>
     */
    public array $sizes = [];

    protected Images $config;

    protected string $type = 'image';

    public function __get($property)
    {
        if (str_ends_with($property, '_url') || str_ends_with($property, '_path') || str_ends_with(
            $property,
            '_mimetype'
        )) {
            $this->initSizeProperties();
        }

        parent::__get($property);
    }

    public function setFileMetadata(string $metadata): self
    {
        $this->attributes['file_metadata'] = $metadata;

        $metadataArray = json_decode($metadata, true);
        if (! array_key_exists('sizes', $metadataArray)) {
            return $this;
        }

        $this->sizes = $metadataArray['sizes'];

        return $this;
    }

    public function initSizeProperties(): bool
    {
        if ($this->file_path === '') {
            return false;
        }

        if ($this->sizes === []) {
            $this->sizes = $this->file_metadata['sizes'];
        }

        helper('media');

        $extension = $this->file_extension;
        $mimetype = $this->mimetype;
        foreach ($this->sizes as $name => $size) {
            if (array_key_exists('extension', $size)) {
                $extension = $size['extension'];
            }
            if (array_key_exists('mimetype', $size)) {
                $mimetype = $size['mimetype'];
            }
            $this->{$name . '_path'} = $this->file_directory . '/' . $this->file_name . '_' . $name . '.' . $extension;
            $this->{$name . '_url'} = media_base_url($this->{$name . '_path'});
            $this->{$name . '_mimetype'} = $mimetype;
        }

        return true;
    }

    public function saveInDisk(File $file, string $dirname, string $filename): void
    {
        // save original
        parent::saveInDisk($file, $dirname, $filename);

        $this->initSizeProperties();

        // save derived sizes
        $imageService = service('image');
        foreach ($this->sizes as $name => $size) {
            $pathProperty = $name . '_path';
            $imageService
                ->withFile(media_path($this->file_path))
                ->resize($size['width'], $size['height']);
            $imageService->save(media_path($this->{$pathProperty}));
        }
    }

    public function injectFileData(File $file): void
    {
        $metadata = exif_read_data(media_path($this->file_path), null, true);

        if ($metadata) {
            $metadata['sizes'] = $this->sizes;
            $this->file_size = $metadata['FILE']['FileSize'];
            $this->file_metadata = $metadata;
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
