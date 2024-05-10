<?php

declare(strict_types=1);

namespace App\Views\Components;

use ViewComponents\Component;

class Button extends Component
{
    protected array $props = ['uri', 'variant', 'size', 'iconLeft', 'iconRight', 'isSquared', 'isExternal'];

    protected array $casts = [
        'isSquared'  => 'boolean',
        'isExternal' => 'boolean',
    ];

    protected string $uri = '';

    protected string $variant = 'default';

    /**
     * @var 'small'|'base'|'large'
     */
    protected string $size = 'base';

    protected string $iconLeft = '';

    protected string $iconRight = '';

    protected bool $isSquared = false;

    protected bool $isExternal = false;

    public function render(): string
    {
        $this->mergeClass('shadow gap-x-2 flex-shrink-0 inline-flex items-center justify-center font-semibold rounded-full');

        $variantClass = match ($this->variant) {
            'primary'   => 'text-accent-contrast bg-accent-base hover:bg-accent-hover',
            'secondary' => 'ring-2 ring-accent-base ring-inset text-accent-base bg-white hover:border-accent-hover hover:text-accent-hover hover:ring-accent-hover',
            'danger'    => 'bg-red-50 ring-2 ring-red-700 ring-inset text-red-700 hover:ring-red-800 hover:text-red-800',
            'warning'   => 'bg-yellow-50 ring-2 ring-yellow-700 ring-inset text-yellow-700 hover:ring-yellow-800 hover:text-yellow-800',
            'info'      => 'bg-blue-50 ring-2 ring-blue-700 ring-inset text-blue-700 hover:ring-blue-800 hover:text-blue-800',
            'disabled'  => 'text-black bg-gray-300 cursor-not-allowed',
            default     => 'text-black bg-gray-50 hover:bg-gray-200',
        };

        $sizeClass = match ($this->size) {
            'small' => 'text-xs leading-6',
            'large' => 'text-base leading-6',
            default => 'text-sm leading-5',
        };

        $iconSizeClass = match ($this->size) {
            'small' => 'text-sm',
            'large' => 'text-2xl',
            default => 'text-lg',
        };

        $basePaddings = match ($this->size) {
            'small' => 'px-3 py-1',
            'large' => 'px-4 py-2',
            default => 'px-3 py-2',
        };

        $squaredPaddings = match ($this->size) {
            'small' => 'p-1',
            'large' => 'p-3',
            default => 'p-2',
        };

        $this->mergeClass($variantClass);
        $this->mergeClass($sizeClass);

        if ($this->isSquared) {
            $this->mergeClass($squaredPaddings);
        } else {
            $this->mergeClass($basePaddings);
        }

        if ($this->iconLeft !== '' || $this->iconRight !== '') {
            $this->slot = '<span>' . $this->slot . '</span>';
        }

        if ($this->iconLeft !== '') {
            $this->slot = icon($this->iconLeft, [
                'class' => 'opacity-75 ' . $iconSizeClass,
            ]) . $this->slot;
        }

        if ($this->iconRight !== '') {
            $this->slot .= icon($this->iconRight, [
                'class' => 'opacity-75 ' . $iconSizeClass,
            ]);
        }

        if ($this->uri !== '') {
            $tagName = 'a';
            $this->attributes['href'] = $this->uri;
            if ($this->isExternal) {
                $this->attributes['target'] = '_blank';
                $this->attributes['rel'] = 'noopener noreferrer';
            }
        } else {
            $tagName = 'button';
            $this->attributes['type'] ??= 'button';
        }

        return <<<HTML
            <{$tagName} {$this->getStringifiedAttributes()}>{$this->slot}</{$tagName}>
        HTML;
    }
}
