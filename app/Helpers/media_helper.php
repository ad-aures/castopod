<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Mimes;
use Config\Services;

if (! function_exists('save_media')) {
    /**
     * Saves a file to the corresponding podcast folder in `public/media`
     *
     * @param File|UploadedFile $file
     */
    function save_media(File $file, string $folder = '', string $filename = ''): string
    {
        if (($extension = $file->getExtension()) !== '') {
            $filename = $filename . '.' . $extension;
        }

        $mediaRoot = config('App')
            ->mediaRoot . '/' . $folder;

        if (! file_exists($mediaRoot)) {
            mkdir($mediaRoot, 0777, true);
            touch($mediaRoot . '/index.html');
        }

        // move to media folder, overwrite file if already existing
        $file->move($mediaRoot . '/', $filename, true);

        return $folder . '/' . $filename;
    }
}

if (! function_exists('download_file')) {
    function download_file(string $fileUrl, string $mimetype = ''): File
    {
        $client = Services::curlrequest();

        $response = $client->get($fileUrl, [
            'headers' => [
                'User-Agent' => 'Castopod/' . CP_VERSION,
            ],
        ]);

        // redirect to new file location
        $newFileUrl = $fileUrl;
        while (
            in_array(
                $response->getStatusCode(),
                [
                    ResponseInterface::HTTP_MOVED_PERMANENTLY,
                    ResponseInterface::HTTP_FOUND,
                    ResponseInterface::HTTP_SEE_OTHER,
                    ResponseInterface::HTTP_NOT_MODIFIED,
                    ResponseInterface::HTTP_TEMPORARY_REDIRECT,
                    ResponseInterface::HTTP_PERMANENT_REDIRECT,
                ],
                true,
            )
        ) {
            $newFileUrl = trim($response->getHeader('location')->getValue());
            $response = $client->get($newFileUrl, [
                'headers' => [
                    'User-Agent' => 'Castopod/' . CP_VERSION,
                ],
                'http_errors' => false,
            ]);
        }

        $fileExtension = pathinfo(parse_url($newFileUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
        $extension = $fileExtension === '' ? Mimes::guessExtensionFromType($mimetype) : $fileExtension;
        $tmpFilename =
            time() .
            '_' .
            bin2hex(random_bytes(10)) .
            '.' .
            $extension;
        $tmpFilePath = WRITEPATH . 'uploads/' . $tmpFilename;
        file_put_contents($tmpFilePath, $response->getBody());

        return new File($tmpFilePath);
    }
}
if (! function_exists('media_path')) {
    /**
     * Prefixes the root media path to a given uri
     *
     * @param  string|string[] $uri URI string or array of URI segments
     */
    function media_path(string | array $uri = ''): string
    {
        // convert segment array to string
        if (is_array($uri)) {
            $uri = implode('/', $uri);
        }
        $uri = trim($uri, '/');

        return config('App')->mediaRoot . '/' . $uri;
    }
}

if (! function_exists('media_base_url')) {
    /**
     * Return the media base URL to use in views
     *
     * @param  string|string[] $uri URI string or array of URI segments
     */
    function media_base_url(string | array $uri = ''): string
    {
        // convert segment array to string
        if (is_array($uri)) {
            $uri = implode('/', $uri);
        }
        $uri = trim($uri, '/');

        $appConfig = config('App');
        $mediaBaseUrl = $appConfig->mediaBaseURL === '' ? $appConfig->baseURL : $appConfig->mediaBaseURL;

        return rtrim($mediaBaseUrl, '/') .
            '/' .
            $appConfig->mediaRoot .
            '/' .
            $uri;
    }
}
