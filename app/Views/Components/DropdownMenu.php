<?php

declare(strict_types=1);

namespace App\Views\Components;

use Exception;
use ViewComponents\Component;

class DropdownMenu extends Component
{
    protected array $props = ['id', 'labelledby', 'placement', 'offsetX', 'offsetY', 'items'];

    protected array $casts = [
        'offsetX' => 'number',
        'offsetY' => 'number',
        'items'   => 'array',
    ];

    protected string $id;

    protected string $labelledby;

    protected string $placement = 'bottom-end';

    protected int $offsetX = 0;

    protected int $offsetY = 0;

    protected array $items = [];

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
                        'class' => 'inline-flex gap-x-1 items-center px-4 py-1 hover:bg-highlight' . (array_key_exists('class', $item) ? ' ' . $item['class'] : ''),
                    ]);
                    break;
                case 'html':
                    $menuItems .= htmlspecialchars_decode((string) $item['content']);
                    break;
                case 'separator':
                    $menuItems .= '<hr class="my-2 border border-subtle">';
                    break;
                default:
                    break;
            }
        }

        $this->mergeClass('absolute flex flex-col py-2 rounded-lg z-60 whitespace-nowrap text-skin-base border-contrast bg-elevated border-3');
        $this->attributes['id'] = $this->id;
        $this->attributes['aria-labelledby'] = $this->labelledby;
        $this->attributes['data-dropdown'] = 'menu';
        $this->attributes['data-dropdown-placement'] = $this->placement;
        $this->attributes['data-dropdown-offset-x'] = $this->offsetX;
        $this->attributes['data-dropdown-offset-y'] = $this->offsetY;

        return <<<HTML
            <nav {$this->getStringifiedAttributes()}>{$menuItems}</nav>
        HTML;
    }
}
