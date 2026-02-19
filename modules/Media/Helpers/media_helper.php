<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use CodeIgniter\Files\File;
use Config\Mimes;

if (! function_exists('download_file')) {
    function download_file(string $fileUrl, string $mimetype = ''): File
    {
        $fileExtension = pathinfo(parse_url($fileUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
        $extension = $fileExtension === '' ? Mimes::guessExtensionFromType($mimetype) : $fileExtension;
        $tmpFilename =
            time() .
            '_' .
            bin2hex(random_bytes(10)) .
            '.' .
            $extension;
        $tmpfilePath = WRITEPATH . 'uploads/' . $tmpFilename;

        $file = fopen($tmpfilePath, 'w');
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $fileUrl);

        // output directly to file
        curl_setopt($ch, CURLOPT_FILE, $file);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['User-Agent: Castopod/' . CP_VERSION]);

        // follow redirects up to 20, like Apple Podcasts
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 20);

        curl_exec($ch);

        fclose($file);

        return new File($tmpfilePath);
    }
}
