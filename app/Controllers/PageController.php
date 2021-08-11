<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Entities\Page;
use App\Models\PageModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PageController extends BaseController
{
    protected Page $page;

    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (
            ($page = (new PageModel())->where('slug', $params[0])->first()) === null
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->page = $page;

        return $this->{$method}();
    }

    public function index(): string
    {
        $cacheName = "page-{$this->page->slug}";
        if (! ($found = cache($cacheName))) {
            $data = [
                'page' => $this->page,
            ];

            $found = view('page', $data);

            // The page cache is set to a decade so it is deleted manually upon page update
            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }
}
