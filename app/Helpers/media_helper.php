<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

/**
 * Saves a file to the corresponding podcast folder in `public/media`
 *
 * @param \CodeIgniter\HTTP\Files\UploadedFile|\CodeIgniter\Files\File $file
 * @param string $podcast_name
 * @param string $file_name
 *
 * @return string The episode's file path in media root
 */
function save_podcast_media($file, $podcast_name, $media_name)
{
    $file_name = $media_name . '.' . $file->getExtension();

    if (!file_exists(config('App')->mediaRoot . '/' . $podcast_name)) {
        mkdir(config('App')->mediaRoot . '/' . $podcast_name, 0777, true);
        touch(config('App')->mediaRoot . '/' . $podcast_name . '/index.html');
    }

    // move to media folder and overwrite file if already existing
    $file->move(
        config('App')->mediaRoot . '/' . $podcast_name . '/',
        $file_name,
        true
    );

    return $podcast_name . '/' . $file_name;
}

function download_file($fileUrl)
{
    $tmpFilename =
        time() .
        '_' .
        bin2hex(random_bytes(10)) .
        '.' .
        pathinfo($fileUrl, PATHINFO_EXTENSION);
    $tmpFilePath = WRITEPATH . 'uploads/' . $tmpFilename;
    file_put_contents($tmpFilePath, file_get_contents($fileUrl));

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
