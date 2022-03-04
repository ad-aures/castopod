<?php

declare(strict_types=1);

namespace App\Views\Components;

use Exception;
use ViewComponents\Component;

class DropdownMenu extends Component
{
    public string $id = '';

    public string $labelledby;

    public string $placement = 'bottom-end';

    public string $offsetX = '0';

    public string $offsetY = '0';

    public array $items = [];

    public function setItems(string $value): void
    {
        $this->items = json_decode(htmlspecialchars_decode($value), true);
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
                        'class' => 'px-4 py-1 hover:bg-highlight focus:ring-accent focus:ring-inset' . (array_key_exists('class', $item) ? ' ' . $item['class'] : ''),
                    ]);
                    break;
                case 'html':
                    $menuItems .= htmlspecialchars_decode($item['content']);
                    break;
                case 'separator':
                    $menuItems .= '<hr class="my-2 border border-subtle">';
                    break;
                default:
                    break;
            }
        }

        return <<<HTML
            <nav id="{$this->id}"
                class="absolute z-50 flex flex-col py-2 whitespace-no-wrap rounded-lg text-skin-base border-contrast bg-elevated border-3"
                aria-labelledby="{$this->labelledby}"
                data-dropdown="menu"
                data-dropdown-placement="{$this->placement}"
                data-dropdown-offset-x="{$this->offsetX}"
                data-dropdown-offset-y="{$this->offsetY}">{$menuItems}</nav>
        HTML;
    }
}
