<?php

declare(strict_types=1);

namespace Modules\Media\FileManagers;

use CodeIgniter\Files\File;
use Exception;
use Modules\Media\Config\Media as MediaConfig;

class FS implements FileManagerInterface
{
    public function __construct(
        protected MediaConfig $config
    ) {
        $this->config = $config;
    }

    /**
     * Saves a file to the corresponding folder in `public/media`
     */
    public function save(File $file, string $path): string | false
    {
        helper('media');

        if ((pathinfo($path, PATHINFO_EXTENSION) === '') && (($extension = $file->getExtension()) !== '')) {
            $path = $path . '.' . $extension;
        }

        $mediaRoot = media_path_absolute();

        if (! file_exists(dirname($mediaRoot . '/' . $path))) {
            mkdir(dirname($mediaRoot . '/' . $path), 0777, true);
        }

        if (! file_exists(dirname($mediaRoot . '/' . $path) . '/index.html')) {
            touch(dirname($mediaRoot . '/' . $path) . '/index.html');
        }

        try {
            // move to media folder, overwrite file if already existing
            $file->move($mediaRoot . '/', $path, true);
        } catch (Exception) {
            return false;
        }

        return $path;
    }

    public function delete(string $key): bool
    {
        helper('media');

        return @unlink(media_path_absolute($key));
    }

    public function getUrl(string $key): string
    {
        $appConfig = config('App');
        $mediaBaseUrl = $this->config->baseURL === '' ? $appConfig->baseURL : $this->config->baseURL;

        return rtrim((string) $mediaBaseUrl, '/') .
            '/' .
            $this->config->root .
            '/' .
            $key;
    }

    public function rename(string $oldKey, string $newKey): bool
    {
        helper('media');

        return rename(media_path_absolute($oldKey), media_path_absolute($newKey));
    }

    public function getFileContents(string $key): string
    {
        helper('media');

        return (string) file_get_contents(media_path_absolute($key));
    }

    public function getFileInput(string $key): string
    {
        helper('media');

        return media_path_absolute($key);
    }

    public function deletePodcastImageSizes(string $podcastHandle): bool
    {
        foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
            $this->deleteAll("podcasts/{$podcastHandle}", "*_*{$ext}");
        }

        return true;
    }

    public function deletePersonImagesSizes(): bool
    {
        foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
            $this->deleteAll('persons', "*_*{$ext}");
        }

        return true;
    }

    public function deleteAll(string $prefix, string $pattern = '*'): bool
    {
        helper('media');

        // delete all in folder?
        if ($pattern === '*') {
            helper('filesystem');

            return delete_files(media_path_absolute($prefix), true);
        }

        $prefix = rtrim($prefix, '/') . '/';

        $imagePaths = glob(media_path_absolute($prefix . $pattern));

        if (! $imagePaths) {
            return true;
        }

        foreach ($imagePaths as $imagePath) {
            @unlink($imagePath);
        }

        return true;
    }

    public function isHealthy(): bool
    {
        helper('media');

        return is_really_writable(media_path_absolute());
    }
}
