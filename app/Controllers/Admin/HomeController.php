<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RedirectResponse;

class HomeController extends BaseController
{
    public function index(): RedirectResponse
    {
        session()->keepFlashdata('message');
        return redirect()->route('podcast-list');
    }
}
