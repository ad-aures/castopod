<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\PlatformModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

/*
 * Provide public access to all platforms so that they can be exported
 */
class PlatformController extends Controller
{
    public function index(): ResponseInterface
    {
        $model = new PlatformModel();

        return $this->response->setJSON($model->getPlatforms());
    }
}
