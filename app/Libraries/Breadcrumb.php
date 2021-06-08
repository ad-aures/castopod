<?php

declare(strict_types=1);

/**
 * Generates and renders a breadcrumb based on the current url segments
 *
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

class Breadcrumb
{
    /**
     * List of breadcrumb links.
     *
     * $links = [ 'text' => 'Example Link', 'href' => 'https://example.com/', ]
     *
     * @var array<array<string, string>>
     */
    protected array $links = [];

    /**
     * Initializes the Breadcrumb object using the segments from current_url by populating the $links property with text
     * and href data
     */
    public function __construct()
    {
        $uri = '';
        foreach (current_url(true)->getSegments() as $segment) {
            $uri .= '/' . $segment;
            $this->links[] = [
                'text' => is_numeric($segment)
                    ? $segment
                    : lang('Breadcrumb.' . $segment),
                'href' => base_url($uri),
            ];
        }
    }

    /**
     * Replaces all numeric text in breadcrumb's $link property with new params at same position
     *
     * Given a breadcrumb with numeric params, this function replaces them with the values provided in $newParams
     *
     * Example with `Home / podcasts / 1 / episodes / 1`
     *
     * $newParams = [ 0 => 'foo', 1 => 'bar' ] replaceParams($newParams);
     *
     * The breadcrumb is now `Home / podcasts / foo / episodes / bar`
     *
     * @param string[] $newParams
     */
    public function replaceParams(array $newParams): void
    {
        foreach ($this->links as $key => $link) {
            if (is_numeric($link['text'])) {
                $this->links[$key]['text'] = $newParams[0];
                array_shift($newParams);
            }
        }
    }

    /**
     * Renders the breadcrumb object as an accessible html breadcrumb nav
     */
    public function render(string $class = null): string
    {
        $listItems = '';
        $keys = array_keys($this->links);
        foreach ($this->links as $key => $link) {
            if (end($keys) === $key) {
                $listItem =
                    '<li class="breadcrumb-item active" aria-current="page">' .
                    $link['text'] .
                    '</li>';
            } else {
                $listItem =
                    '<li class="breadcrumb-item">' .
                    anchor($link['href'], $link['text']) .
                    '</li>';
            }

            $listItems .= $listItem;
        }

        return '<nav aria-label="' .
            lang('Breadcrumb.label') .
            '"><ol class="breadcrumb ' .
            $class .
            '">' .
            $listItems .
            '</ol></nav>';
    }
}
