<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;
use CodeIgniter\Controller;

class UnknownUserAgents extends Controller
{
    public function index($last_known_id = 0)
    {
        $model = new \App\Models\UnknownUserAgentsModel();

        return $this->response->setJSON($model->getUserAgents($last_known_id));
    }
}
