<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use CodeIgniter\Files\File;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Mimes;
use Config\Services;

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
            $newFileUrl = trim($response->header('location')->getValue());
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
        $tmpfileKey = WRITEPATH . 'uploads/' . $tmpFilename;
        file_put_contents($tmpfileKey, $response->getBody());

        return new File($tmpfileKey);
    }
}
