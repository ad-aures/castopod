<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Files\File;

class Image extends Media
{
    protected string $type = 'image';

    /**
     * @param array<string, mixed>|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);

        if ($this->file_path && $this->file_metadata) {
            $this->sizes = $this->file_metadata['sizes'];
            $this->initSizeProperties();
        }
    }

    public function initSizeProperties(): bool
    {
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

    public function setFile(File $file): self
    {
        parent::setFile($file);

        $metadata = exif_read_data(media_path($this->file_path), null, true);

        if ($metadata) {
            $metadata['sizes'] = $this->sizes;
            $this->attributes['file_size'] = $metadata['FILE']['FileSize'];
            $this->attributes['file_metadata'] = json_encode($metadata);
        }

        // save derived sizes
        $imageService = service('image');
        foreach ($this->sizes as $name => $size) {
            $pathProperty = $name . '_path';
            $imageService
                ->withFile(media_path($this->file_path))
                ->resize($size['width'], $size['height']);
            $imageService->save(media_path($this->{$pathProperty}));
        }

        return $this;
    }
}
