<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use CodeIgniter\Files\File;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Files\UploadedFile;
use Config\Services;

if (!function_exists('save_media')) {
    /**
     * Saves a file to the corresponding podcast folder in `public/media`
     *
     * @param File|UploadedFile $filePath
     */
    function save_media(
        File $filePath,
        string $folder,
        string $mediaName
    ): string {
        $fileName = $mediaName . '.' . $filePath->getExtension();

        $mediaRoot = config('App')->mediaRoot . '/' . $folder;

        if (!file_exists($mediaRoot)) {
            mkdir($mediaRoot, 0777, true);
            touch($mediaRoot . '/index.html');
        }

        // move to media folder and overwrite file if already existing
        $filePath->move($mediaRoot . '/', $fileName, true);

        return $folder . '/' . $fileName;
    }
}

if (!function_exists('download_file')) {
    function download_file(string $fileUrl): File
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
        $tmpFilename =
            time() .
            '_' .
            bin2hex(random_bytes(10)) .
            '.' .
            pathinfo(parse_url($newFileUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
        $tmpFilePath = WRITEPATH . 'uploads/' . $tmpFilename;
        file_put_contents($tmpFilePath, $response->getBody());

        return new File($tmpFilePath);
    }
}
if (!function_exists('media_path')) {
    /**
     * Prefixes the root media path to a given uri
     *
     * @param  string|array  $uri URI string or array of URI segments
     */
    function media_path($uri = ''): string
    {
        // convert segment array to string
        if (is_array($uri)) {
            $uri = implode('/', $uri);
        }
        $uri = trim($uri, '/');

        return config('App')->mediaRoot . '/' . $uri;
    }
}

if (!function_exists('media_base_url')) {
    /**
     * Return the media base URL to use in views
     *
     * @param  string|array $uri      URI string or array of URI segments
     * @param  string $protocol
     */
    function media_base_url($uri = ''): string
    {
        // convert segment array to string
        if (is_array($uri)) {
            $uri = implode('/', $uri);
        }
        $uri = trim($uri, '/');

        return rtrim(config('App')->mediaBaseURL, '/') .
            '/' .
            config('App')->mediaRoot .
            '/' .
            $uri;
    }
}
