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

    public function render(): string
    {
        $wrapperClass = $this->attributes['class'];
        unset($this->attributes['class']);

        $this->attributes['class'] = 'form-switch';

        $checkbox = form_checkbox($this->attributes, $this->attributes['value'], $this->checked);
        $hint = $this->hint !== '' ? hint_tooltip(lang('Podcast.form.lock_hint'), 'ml-1') : '';
        return <<<CODE_SAMPLE
            <label class="relative inline-flex items-center {$wrapperClass}">
                {$checkbox}
                <span class="form-switch-slider"></span>
                <span class="ml-2">{$this->label}{$hint}</span>
            </label>
        CODE_SAMPLE;
    }
}
