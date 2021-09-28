<?php

declare(strict_types=1);

namespace App\Views\Components;

use Exception;
use ViewComponents\Component;

class DropdownMenu extends Component
{
    public string $id = '';

    public array $items = [];

    public function setItems(string $value): void
    {
        $this->items = json_decode(html_entity_decode($value), true);
    }

    public function render(): string
    {
        if ($this->items === []) {
            throw new Exception('Dropdown menu has no items');
        }

        $menuItems = '';
        foreach ($this->items as $item) {
            switch ($item['type']) {
                case 'link':
                    $menuItems .= anchor($item['uri'], $item['title'], [
                        'class' => 'px-4 py-1 hover:bg-gray-100' . (array_key_exists('class', $item) ? ' ' . $item['class'] : ''),
                    ]);
                    break;
                case 'separator':
                    $menuItems .= '<hr class="my-2 border border-gray-100">';
                    break;
                default:
                    break;
            }
        }

        return <<<HTML
            <nav id="{$this->id}"
                class="absolute z-50 flex flex-col py-2 text-black whitespace-no-wrap bg-white border-black rounded-lg border-3"
                aria-labelledby="{$this->labeledBy}"
                data-dropdown="menu"
                data-dropdown-placement="bottom-end">{$menuItems}</nav>
        HTML;
    }
}
