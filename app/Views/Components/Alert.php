<?php

declare(strict_types=1);

namespace App\Views\Components;

use ViewComponents\Component;

class Alert extends Component
{
    protected ?string $glyph = null;

    protected ?string $title = null;

    /**
     * @var 'default'|'success'|'danger'|'warning'
     */
    protected string $variant = 'default';

    public function render(): string
    {
        $variantClasses = [
            'default' => 'text-gray-800 bg-gray-100 border-gray-300',
            'success' => 'text-pine-900 bg-pine-100 border-castopod-300',
            'danger' => 'text-red-900 bg-red-100 border-red-300',
            'warning' => 'text-yellow-900 bg-yellow-100 border-yellow-300',
        ];

        $glyph = $this->glyph === null ? '' : '<Icon glyph="' . $this->glyph . '" class="flex-shrink-0 mr-2 text-lg" />';
        $title = $this->title === null ? '' : '<div class="font-semibold">' . $this->title . '</div>';
        $class = 'inline-flex w-full p-2 text-sm border rounded ' . $variantClasses[$this->variant] . ' ' . $this->class;

        $attributes = stringify_attributes($this->attributes);

        return <<<HTML
            <div class="{$class}" role="alert" {$attributes}>{$glyph}<div>{$title}<p>{$this->slot}</p></div></div>
        HTML;
    }
}
