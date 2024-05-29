<?php

declare(strict_types=1);

namespace App\Views\Components;

use Override;
use ViewComponents\Component;

class Pill extends Component
{
    /**
     * @var 'small'|'base'
     */
    public string $size = 'base';

    public string $variant = 'default';

    public string $icon = '';

    public string $iconClass = '';

    protected array $props = ['size', 'variant', 'icon', 'iconClass', 'hint'];

    protected string $hint = '';

    #[Override]
    public function render(): string
    {
        $variantClass = match ($this->variant) {
            'primary' => 'text-accent-contrast bg-accent-base border-accent-base',
            'success' => 'text-pine-900 bg-pine-100 border-pine-300',
            'danger'  => 'text-red-900 bg-red-100 border-red-300',
            'warning' => 'text-yellow-900 bg-yellow-100 border-yellow-300',
            default   => 'text-gray-800 bg-gray-100 border-gray-300',
        };

        $sizeClass = match ($this->size) {
            'small' => 'text-xs tracking-wide',
            default => 'text-sm',
        };

        $icon = $this->icon !== '' ? icon($this->icon, [
            'class' => $this->iconClass,
        ]) : '';

        if ($this->hint !== '') {
            $this->attributes['data-tooltip'] = 'bottom';
            $this->attributes['title'] = $this->hint;
        }

        $this->mergeClass('inline-flex lowercase items-center gap-x-1 px-1 font-semibold border rounded');
        $this->mergeClass($variantClass);
        $this->mergeClass($sizeClass);

        return <<<HTML
            <span {$this->getStringifiedAttributes()}>{$icon}{$this->slot}</span>
        HTML;
    }
}
