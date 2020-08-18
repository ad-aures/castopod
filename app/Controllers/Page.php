<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\PageModel;

class Page extends BaseController
{
    /**
     * @var \App\Entities\Page|null
     */
    protected $page;

    public function _remap($method, ...$params)
    {
        if (count($params) > 0) {
            if (
                !($this->page = (new PageModel())
                    ->where('slug', $params[0])
                    ->first())
            ) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

        return $this->$method();
    }

    public function index()
    {
        // The page cache is set to a decade so it is deleted manually upon page update
        $this->cachePage(DECADE);

        $data = [
            'page' => $this->page,
        ];
        return view('page', $data);
    }
}
