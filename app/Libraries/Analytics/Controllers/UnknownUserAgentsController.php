<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class UnknownUserAgentsController extends Controller
{
    public function index(int $lastKnownId = 0): ResponseInterface
    {
        $model = model('AnalyticsUnknownUserAgentsModel');

        return $this->response->setJSON($model->getUserAgents($lastKnownId));
    }
}
