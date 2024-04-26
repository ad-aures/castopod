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
        $variants = [
            'success' => [
                'class' => 'text-pine-900 bg-pine-100 border-pine-300',
                'glyph' => 'check',
            ],
            'danger' => [
                'class' => 'text-red-900 bg-red-100 border-red-300',
                'glyph' => 'close',
            ],
            'warning' => [
                'class' => 'text-yellow-900 bg-yellow-100 border-yellow-300',
                'glyph' => 'alert',
            ],
            'default' => [
                'class' => 'text-blue-900 bg-blue-100 border-blue-300',
                'glyph' => 'error-warning',
            ],
        ];

        if (! array_key_exists($this->variant, $variants)) {
            $this->variant = 'default';
        }

        $glyph = icon(($this->glyph ?? $variants[$this->variant]['glyph']), 'flex-shrink-0 mr-2 text-lg');
        $title = $this->title === null ? '' : '<div class="font-semibold">' . $this->title . '</div>';
        $class = 'inline-flex w-full p-2 text-sm border rounded ' . $variants[$this->variant]['class'] . ' ' . $this->class;

        unset($this->attributes['slot']);
        unset($this->attributes['variant']);
        unset($this->attributes['class']);
        unset($this->attributes['glyph']);
        $attributes = stringify_attributes($this->attributes);

        return <<<HTML
            <div class="{$class}" role="alert" {$attributes}>{$glyph}<div>{$title}<p>{$this->slot}</p></div></div>
        HTML;
    }
}
