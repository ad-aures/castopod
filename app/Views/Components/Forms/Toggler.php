<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class Toggler extends FormComponent
{
    /**
     * @var 'base'|'small
     */
    protected string $size = 'base';

    protected string $label = '';

    protected string $hint = '';

    protected bool $checked = false;

    public function setChecked(string $value): void
    {
        $this->checked = $value === 'true';
    }

    public function render(): string
    {
        unset($this->attributes['checked']);

        $wrapperClass = $this->class;
        unset($this->attributes['class']);

        $sizeClass = [
            'base' => 'form-switch-slider',
            'small' => 'form-switch-slider form-switch-slider--small',
        ];

        $this->attributes['class'] = 'form-switch';

        $checkbox = form_checkbox($this->attributes, $this->value, old($this->name) === 'yes' ? true : $this->checked);
        $hint = $this->hint === '' ? '' : hint_tooltip($this->hint, 'ml-1');
        return <<<HTML
            <label class="relative inline-flex items-center {$wrapperClass}">
                {$checkbox}
                <span class="{$sizeClass[$this->size]}"></span>
                <span class="ml-2">{$this->slot}{$hint}</span>
            </label>
        HTML;
    }
}
