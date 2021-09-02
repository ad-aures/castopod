<?php

declare(strict_types=1);

namespace App\Views\Components;

use ViewComponents\Component;

class Button extends Component
{
    protected string $label = '';

    protected string $uri = '';

    protected string $variant = 'default';

    protected string $size = 'base';

    protected string $iconLeft = '';

    protected string $iconRight = '';

    protected bool $isSquared = false;

    public function render(): string
    {
        $baseClass =
            'inline-flex items-center justify-center font-semibold shadow-xs rounded-full focus:outline-none focus:ring';

        $variantClass = [
            'default' => 'text-black bg-gray-300 hover:bg-gray-400',
            'primary' => 'text-white bg-pine-700 hover:bg-pine-800',
            'secondary' => 'text-white bg-gray-700 hover:bg-gray-800',
            'accent' => 'text-white bg-rose-600 hover:bg-rose-800',
            'success' => 'text-white bg-green-600 hover:bg-green-700',
            'danger' => 'text-white bg-red-600 hover:bg-red-700',
            'warning' => 'text-black bg-yellow-500 hover:bg-yellow-600',
            'info' => 'text-white bg-blue-500 hover:bg-blue-600',
        ];

        $sizeClass = [
            'small' => 'text-xs md:text-sm',
            'base' => 'text-sm md:text-base',
            'large' => 'text-lg md:text-xl',
        ];

        $basePaddings = [
            'small' => 'px-2 md:px-3 md:py-1',
            'base' => 'px-3 py-1 md:px-4 md:py-2',
            'large' => 'px-3 py-2 md:px-5',
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
            $this->slot = '<Icon glyph="' . $this->iconLeft . '" class="mr-2" />' . $this->slot;
        }

        if ($this->iconRight !== '') {
            $this->slot .= '<Icon glyph="' . $this->iconRight . '" class="ml-2" />';
        }

        if ($this->uri !== '') {
            return anchor($this->uri, $this->label, array_merge([
                'class' => $buttonClass,
            ], $this->attributes));
        }

        $defaultButtonAttributes = [
            'type' => 'button',
        ];
        $attributes = stringify_attributes(array_merge($defaultButtonAttributes, $this->attributes));

        return <<<HTML
            <button class="{$buttonClass}" {$attributes}>{$this->slot}</button>
        HTML;
    }
}
