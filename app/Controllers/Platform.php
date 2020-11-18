<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use CodeIgniter\Controller;

/*
 * Provide public access to all platforms so that they can be exported
 */
class Platform extends Controller
{
    public function index()
    {
        $model = new \App\Models\PlatformModel();

        return $this->response->setJSON($model->getPlatforms());
    }
}
