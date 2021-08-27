<?php

declare(strict_types=1);

namespace App\View\Components\Forms;

use ViewComponents\Component;

/**
 * Form Checkbox Switch
 *
 * Abstracts form_label to stylize it as a switch toggle
 */
class Toggler extends Component
{
    /**
     * @var array<string, string>
     */
    protected array $attributes = [
        'id' => '',
        'name' => '',
        'value' => '',
        'class' => '',
    ];

    protected string $label = '';

    protected string $hint = '';

    protected bool $checked = false;

    public function setChecked(string $value): void
    {
        $this->checked = $value !== '';
    }

    public function render(): string
    {
        unset($this->attributes['checked']);

        $wrapperClass = $this->attributes['class'];
        unset($this->attributes['class']);

        $this->attributes['class'] = 'form-switch';

        helper('form');

        $checkbox = form_checkbox($this->attributes, $this->attributes['value'], $this->checked);
        $hint = $this->hint === '' ? '' : hint_tooltip($this->hint, 'ml-1');
        return <<<HTML
            <label class="relative inline-flex items-center {$wrapperClass}">
                {$checkbox}
                <span class="form-switch-slider"></span>
                <span class="ml-2">{$this->slot}{$hint}</span>
            </label>
        HTML;
    }
}
