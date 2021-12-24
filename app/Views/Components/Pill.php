<?php

declare(strict_types=1);

namespace App\Views\Components;

use ViewComponents\Component;

class Pill extends Component
{
    /**
     * @var 'small'|'base'
     */
    public string $size = 'base';

    public string $variant = 'default';

    public ?string $icon = null;

    public function render(): string
    {
        $variantClasses = [
            'default' => 'text-gray-800 bg-gray-100 border-gray-300',
            'primary' => 'text-accent-contrast bg-accent-base border-accent-base',
            'success' => 'text-pine-900 bg-pine-100 border-castopod-300',
            'danger' => 'text-red-900 bg-red-100 border-red-300',
            'warning' => 'text-yellow-900 bg-yellow-100 border-yellow-300',
        ];

        $icon = $this->icon ? icon($this->icon) : '';

        return <<<HTML
            <span class="inline-flex items-center gap-x-1 px-1 font-semibold border rounded {$variantClasses[$this->variant]}">{$icon}{$this->slot}</span>
        HTML;
    }
}
