<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Exceptions\HTTPException;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Saves a file to the corresponding podcast folder in `public/media`
 *
 * @param \CodeIgniter\HTTP\Files\UploadedFile|\CodeIgniter\Files\File $file
 * @param string $podcast_name
 * @param string $file_name
 *
 * @return string The episode's file path in media root
 */
function save_media($file, $folder, $mediaName)
{
    $file_name = $mediaName . '.' . $file->getExtension();

    $mediaRoot = config('App')->mediaRoot . '/' . $folder;

    if (!file_exists($mediaRoot)) {
        mkdir($mediaRoot, 0777, true);
        touch($mediaRoot . '/index.html');
    }

    // move to media folder and overwrite file if already existing
    $file->move($mediaRoot . '/', $file_name, true);

    return $folder . '/' . $file_name;
}

/**
 * @param string $fileUrl
 * @return File
 */
function download_file($fileUrl)
{
    var_dump($fileUrl);

    $client = \Config\Services::curlrequest();
    $uri = new \CodeIgniter\HTTP\URI($fileUrl);

    $response = $client->get($uri, [
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
        $newFileUrl = (string) trim(
            $response->getHeader('location')->getValue(),
        );
        $newLocation = new \CodeIgniter\HTTP\URI($newFileUrl);
        $response = $client->get($newLocation, [
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

    return new \CodeIgniter\Files\File($tmpFilePath);
}

/**
 * Prefixes the root media path to a given uri
 *
 * @param  mixed  $uri      URI string or array of URI segments
 * @return string
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

/**
 * Return the media base URL to use in views
 *
 * @param  mixed  $uri      URI string or array of URI segments
 * @param  string $protocol
 * @return string
 */
function media_url($uri = '', string $protocol = null): string
{
    return base_url(config('App')->mediaRoot . '/' . $uri, $protocol);
}

function media_base_url($uri = '')
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
