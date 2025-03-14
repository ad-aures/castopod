<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Validation;

use CodeIgniter\Validation\FileRules as ValidationFileRules;
use Override;

class FileRules extends ValidationFileRules
{
    /**
     * Checks an uploaded file to verify that the dimensions are within a specified allowable dimension.
     */
    #[Override]
    public function min_dims(?string $blank = null, string $params = ''): bool
    {
        // Grab the file name off the top of the $params
        // after we split it.
        $params = explode(',', $params);
        $name = array_shift($params);

        if (! ($files = $this->request->getFileMultiple($name))) {
            $files = [$this->request->getFile($name)];
        }

        foreach ($files as $file) {
            if ($file === null) {
                return false;
            }

            if ($file->getError() === UPLOAD_ERR_NO_FILE) {
                return true;
            }

            // Get Parameter sizes
            $minWidth = $params[0] ?? 0;
            $minHeight = $params[1] ?? 0;

            // Get uploaded image size
            $info = getimagesize($file->getTempName());
            $fileWidth = $info[0];
            $fileHeight = $info[1];

            if ($fileWidth < $minWidth || $fileHeight < $minHeight) {
                return false;
            }
        }

        return true;
    }

    //--------------------------------------------------------------------

    /**
     * Checks an uploaded image to verify that the ratio corresponds to the params
     */
    public function is_image_ratio(?string $blank = null, string $params = ''): bool
    {
        // Grab the file name off the top of the $params
        // after we split it.
        $params = explode(',', $params);
        $name = array_shift($params);

        if (! ($files = $this->request->getFileMultiple($name))) {
            $files = [$this->request->getFile($name)];
        }

        foreach ($files as $file) {
            if ($file === null) {
                return false;
            }

            if ($file->getError() === UPLOAD_ERR_NO_FILE) {
                return true;
            }

            // Get Parameter sizes
            $x = $params[0] ?? 1;
            $y = $params[1] ?? 1;

            // Get uploaded image size
            [0 => $fileWidth, 1 => $fileHeight] = getimagesize($file->getTempName());

            if (($x / $y) !== ($fileWidth / $fileHeight)) {
                return false;
            }
        }

        return true;
    }

    //--------------------------------------------------------------------

    /**
     * Checks that an uploaded json file's content is valid
     */
    public function is_json(?string $blank = null, string $params = ''): bool
    {
        // Grab the file name off the top of the $params
        // after we split it.
        $params = explode(',', $params);
        $name = array_shift($params);

        if (! ($files = $this->request->getFileMultiple($name))) {
            $files = [$this->request->getFile($name)];
        }

        foreach ($files as $file) {
            if ($file === null) {
                return false;
            }

            if ($file->getError() === UPLOAD_ERR_NO_FILE) {
                return true;
            }

            $content = file_get_contents($file->getTempName());

            if ($content === false) {
                return false;
            }

            json_decode($content);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return false;
            }
        }

        return true;
    }
}
