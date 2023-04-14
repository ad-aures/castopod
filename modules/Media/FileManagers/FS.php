<?php

declare(strict_types=1);

namespace Modules\Media\FileManagers;

use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Response;
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

        $mediaRoot = $this->media_path_absolute();

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

        return @unlink($this->media_path_absolute($key));
    }

    public function getUrl(string $key): string
    {
        return media_url($this->config->root . '/' . $key);
    }

    public function rename(string $oldKey, string $newKey): bool
    {
        helper('media');

        return rename($this->media_path_absolute($oldKey), $this->media_path_absolute($newKey));
    }

    public function getFileContents(string $key): string|false
    {
        helper('media');

        return file_get_contents($this->media_path_absolute($key));
    }

    public function getFileInput(string $key): string
    {
        helper('media');

        return $this->media_path_absolute($key);
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

            return delete_files($this->media_path_absolute($prefix), true);
        }

        $prefix = rtrim($prefix, '/') . '/';

        $imagePaths = glob($this->media_path_absolute($prefix . $pattern));

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

        return is_really_writable($this->media_path_absolute());
    }

    public function serve(string $key): Response
    {
        return redirect()->to($this->getUrl($key));
    }

    /**
     * Prefixes the absolute storage directory to the media path of a given uri
     *
     * @param  string|string[] $uri URI string or array of URI segments
     */
    private function media_path_absolute(string | array $uri = ''): string
    {
        // convert segment array to string
        if (is_array($uri)) {
            $uri = implode('/', $uri);
        }

        $uri = trim($uri, '/');

        return config('Media')->storage . '/' . config('Media')->root . '/' . $uri;
    }
}
