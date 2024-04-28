<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Media\Entities;

use CodeIgniter\Files\File;
use Config\Services;
use GdImage;

/**
 * @property array $sizes
 */
class Image extends BaseMedia
{
    protected string $type = 'image';

    /**
     * @var array<string, array<string, int|string>>
     */
    protected array $sizes = [];

    public function initFileProperties(): void
    {
        parent::initFileProperties();

        if ($this->file_metadata && array_key_exists('sizes', $this->file_metadata)) {
            $this->sizes = $this->file_metadata['sizes'];
            $this->initSizeProperties();
        }
    }

    public function initSizeProperties(): bool
    {
        helper('filesystem');

        foreach ($this->sizes as $name => $size) {
            $extension = array_key_exists('extension', $size) ? $size['extension'] : $this->file_extension;
            $mimetype = array_key_exists('mimetype', $size) ? $size['mimetype'] : $this->file_mimetype;

            $this->{$name . '_key'} = change_file_path($this->file_key, '_' . $name, $extension);
            $this->{$name . '_url'} = service('file_manager')->getUrl($this->{$name . '_key'});
            $this->{$name . '_mimetype'} = $mimetype;
        }

        return true;
    }

    /**
     * @param array<string, string> $data
     */
    public function injectRawData(array $data): static
    {
        parent::injectRawData($data);

        if ($this->attributes === []) {
            return $this;
        }

        if ($this->file_metadata !== [] && array_key_exists('sizes', $this->file_metadata)) {
            $this->sizes = $this->file_metadata['sizes'];
            $this->attributes['sizes'] = $this->file_metadata['sizes'];
            $this->initFileProperties();
            $this->initSizeProperties();
        }

        return $this;
    }

    public function setFile(File $file): self
    {
        parent::setFile($file);

        if ($this->file_mimetype === 'image/jpeg' && $metadata = @exif_read_data(
            $file->getRealPath(),
            null,
            true
        )) {
            $metadata['sizes'] = $this->attributes['sizes'];
            $this->attributes['file_size'] = $metadata['FILE']['FileSize'];
        } else {
            $metadata = [
                'sizes' => $this->attributes['sizes'],
            ];
        }

        $this->attributes['file_metadata'] = json_encode($metadata, JSON_INVALID_UTF8_IGNORE);

        return $this;
    }

    public function saveFile(): void
    {
        if ($this->attributes['sizes'] !== []) {
            $this->initFileProperties();
            $this->saveSizes();
        }

        parent::saveFile();
    }

    public function deleteFile(): bool
    {
        if (parent::deleteFile()) {
            return $this->deleteSizes();
        }

        return false;
    }

    public function saveSizes(): void
    {
        $tempImagePath = '';
        if (! array_key_exists('file', $this->attributes) && $this->file_key) {
            // no original file instance set to save sizes from

            // download image temporarily to generate sizes from
            $tempImagePath = (string) tempnam(WRITEPATH . 'temp', 'img_');
            $imageContent = (string) service('file_manager')
                ->getFileContents($this->file_key);
            file_put_contents($tempImagePath, $imageContent);

            $this->attributes['file'] = new File($tempImagePath, true);
        }

        // save derived sizes
        $imageService = Services::image();

        foreach ($this->sizes as $name => $size) {
            $tempFilePath = tempnam(WRITEPATH . 'temp', 'img_');
            $resizedImage = $imageService
                ->withFile($this->attributes['file']->getRealPath())
                ->resize($size['width'], $size['height']);

            /** @var GdImage $resizedImageResource */
            $resizedImageResource = $resizedImage->getResource();

            // set resolution to 72 by 72 for all sizes
            // Apple Podcasts requires images to be 72 dpi
            imageresolution($resizedImageResource, 72, 72);

            $resizedImage->save($tempFilePath);

            $newImage = new File($tempFilePath, true);

            service('file_manager')
                ->save($newImage, $this->{$name . '_key'});
        }

        if ($tempImagePath !== '') {
            unlink($tempImagePath);
        }
    }

    private function deleteSizes(): bool
    {
        // delete all derived sizes
        foreach (array_keys($this->sizes) as $name) {
            $pathProperty = $name . '_key';

            if (! service('file_manager')->delete($this->{$pathProperty})) {
                return false;
            }
        }

        return true;
    }
}
