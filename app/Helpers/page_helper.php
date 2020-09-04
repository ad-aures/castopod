<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use App\Models\PageModel;

/**
 * Returns instance pages as links inside nav tag
 *
 * @param string $class
 * @return string html pages navigation
 */
function render_page_links($class = null)
{
    $pages = (new PageModel())->findAll();
    $links = anchor(route_to('home'), lang('Common.home'), [
        'class' => 'px-2 underline hover:no-underline',
    ]);
    foreach ($pages as $page) {
        $links .= anchor($page->link, $page->title, [
            'class' => 'px-2 underline hover:no-underline',
        ]);
    }

    return '<nav class="' . $class . '">' . $links . '</nav>';
}
