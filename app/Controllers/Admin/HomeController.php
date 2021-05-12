<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

class HomeController extends BaseController
{
    public function index()
    {
        session()->keepFlashdata('message');
        return redirect()->route('podcast-list');
    }
}
