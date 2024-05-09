<?php

declare(strict_types=1);

namespace App\Views\Components;

use ViewComponents\Component;

class Alert extends Component
{
    protected array $props = ['glyph', 'title'];

    protected string $glyph = '';

    protected ?string $title = '';

    protected array $attributes = [
        'role' => 'alert',
    ];

    /**
     * @var 'default'|'success'|'danger'|'warning'
     */
    protected string $variant = 'default';

    public function render(): string
    {
        $variantData = match ($this->variant) {
            'success' => [
                'class' => 'text-pine-900 bg-pine-100 border-pine-300',
                'glyph' => 'check-fill', // @icon('check-fill')
            ],
            'danger' => [
                'class' => 'text-red-900 bg-red-100 border-red-300',
                'glyph' => 'close-fill', // @icon('close-fill')
            ],
            'warning' => [
                'class' => 'text-yellow-900 bg-yellow-100 border-yellow-300',
                'glyph' => 'alert-fill', // @icon('alert-fill')
            ],
            default => [
                'class' => 'text-blue-900 bg-blue-100 border-blue-300',
                'glyph' => 'error-warning-fill', // @icon('error-warning-fill')
            ],
        };

        $glyph = icon(($this->glyph === '' ? $variantData['glyph'] : $this->glyph), [
            'class' => 'flex-shrink-0 mr-2 text-lg',
        ]);
        $title = $this->title === '' ? '' : '<div class="font-semibold">' . $this->title . '</div>';
        $this->mergeClass('inline-flex w-full p-2 text-sm border rounded ');
        $this->mergeClass($variantData['class']);

        return <<<HTML
            <div {$this->getStringifiedAttributes()}>{$glyph}<div>{$title}<p>{$this->slot}</p></div></div>
        HTML;
    }
}
