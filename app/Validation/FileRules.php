<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Validation;

use CodeIgniter\Validation\FileRules as ValidationFileRules;

class FileRules extends ValidationFileRules
{
    /**
     * Checks an uploaded file to verify that the dimensions are within
     * a specified allowable dimension.
     *
     * @param string|null $blank
     * 
     */
    public function min_dims(string $blank = null, string $params): bool
    {
        // Grab the file name off the top of the $params
        // after we split it.
        $params = explode(',', $params);
        $name = array_shift($params);

        if (!($files = $this->request->getFileMultiple($name))) {
            $files = [$this->request->getFile($name)];
        }

        foreach ($files as $file) {
            if (is_null($file)) {
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
     * Checks an uploaded file to verify that the image ratio is of 1:1
     *
     * @param string|null $blank
     *
     */
    public function is_image_squared(string $blank = null, string $params): bool
    {
        // Grab the file name off the top of the $params
        // after we split it.
        $params = explode(',', $params);
        $name = array_shift($params);

        if (!($files = $this->request->getFileMultiple($name))) {
            $files = [$this->request->getFile($name)];
        }

        foreach ($files as $file) {
            if (is_null($file)) {
                return false;
            }

            if ($file->getError() === UPLOAD_ERR_NO_FILE) {
                return true;
            }

            // Get uploaded image size
            $info = getimagesize($file->getTempName());
            $fileWidth = $info[0];
            $fileHeight = $info[1];

            if ($fileWidth != $fileHeight) {
                return false;
            }
        }

        return true;
    }

    //--------------------------------------------------------------------
}
