<?php

declare(strict_types=1);

namespace App\Views\Components;

use ViewComponents\Component;

class Button extends Component
{
    protected string $uri = '';

    protected string $variant = 'default';

    protected string $size = 'base';

    protected string $iconLeft = '';

    protected string $iconRight = '';

    protected bool $isSquared = false;

    public function setIsSquared(string $value): void
    {
        $this->isSquared = $value === 'true';
    }

    public function render(): string
    {
        $baseClass =
            'flex-shrink-0 inline-flex items-center justify-center font-semibold shadow-xs rounded-full focus:ring-accent';

        $variantClass = [
            'default' => 'text-black bg-gray-300 hover:bg-gray-400',
            'primary' => 'text-accent-contrast bg-accent-base hover:bg-accent-hover',
            'secondary' => 'border-2 border-accent-base text-accent-base bg-white hover:border-accent-hover hover:text-accent-hover',
            'success' => 'text-white bg-pine-500 hover:bg-pine-800',
            'danger' => 'text-white bg-red-600 hover:bg-red-700',
            'warning' => 'text-black bg-yellow-500 hover:bg-yellow-600',
            'info' => 'text-white bg-blue-500 hover:bg-blue-600',
            'disabled' => 'text-black bg-gray-300 cursor-not-allowed',
        ];

        $sizeClass = [
            'small' => 'text-xs leading-6',
            'base' => 'text-sm leading-5',
            'large' => 'text-base leading-6',
        ];

        $iconSize = [
            'small' => 'text-sm',
            'base' => 'text-lg',
            'large' => 'text-2xl',
        ];

        $basePaddings = [
            'small' => 'px-3 py-1',
            'base' => 'px-3 py-2',
            'large' => 'px-4 py-2',
        ];

        $squaredPaddings = [
            'small' => 'p-1',
            'base' => 'p-2',
            'large' => 'p-3',
        ];

        $buttonClass =
            $baseClass .
            ' ' .
            ($this->isSquared
                ? $squaredPaddings[$this->size]
                : $basePaddings[$this->size]) .
            ' ' .
            $sizeClass[$this->size] .
            ' ' .
            $variantClass[$this->variant];

        if (array_key_exists('class', $this->attributes)) {
            $buttonClass .= ' ' . $this->attributes['class'];
            unset($this->attributes['class']);
        }

        if ($this->iconLeft !== '') {
            $this->slot = (new Icon([
                'glyph' => $this->iconLeft,
                'class' => 'mr-2 opacity-75' . ' ' . $iconSize[$this->size],
            ]))->render() . $this->slot;
        }

        if ($this->iconRight !== '') {
            $this->slot .= (new Icon([
                'glyph' => $this->iconRight,
                'class' => 'ml-2 opacity-75' . ' ' . $iconSize[$this->size],
            ]))->render();
        }

        unset($this->attributes['slot']);
        unset($this->attributes['variant']);
        unset($this->attributes['size']);
        unset($this->attributes['iconLeft']);
        unset($this->attributes['iconRight']);
        unset($this->attributes['isSquared']);
        unset($this->attributes['uri']);
        unset($this->attributes['label']);

        if ($this->uri !== '') {
            $tagName = 'a';
            $defaultButtonAttributes = [
                'href' => $this->uri,
            ];
        } else {
            $tagName = 'button';
            $defaultButtonAttributes = [
                'type' => 'button',
            ];
        }

        $attributes = stringify_attributes(array_merge($defaultButtonAttributes, $this->attributes));

        return <<<HTML
            <{$tagName} class="{$buttonClass}" {$attributes}>{$this->slot}</{$tagName}>
        HTML;
    }
}
