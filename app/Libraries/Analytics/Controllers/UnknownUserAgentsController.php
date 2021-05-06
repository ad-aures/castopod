<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Controller;

class UnknownUserAgentsController extends Controller
{
    public function index($lastKnownId = 0): ResponseInterface
    {
        $model = model('UnknownUserAgentsModel');

        return $this->response->setJSON($model->getUserAgents($lastKnownId));
    }
}
