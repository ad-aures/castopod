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
 * @return string html pages navigation
 */
function render_page_links()
{
    $pages = (new PageModel())->findAll();
    $links = '';
    foreach ($pages as $page) {
        $links .= anchor($page->link, $page->title, [
            'class' => 'px-2 underline hover:no-underline',
        ]);
    }

    return '<nav class="inline-flex">' . $links . '</nav>';
}
