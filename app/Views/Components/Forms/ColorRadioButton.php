<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class ColorRadioButton extends FormComponent
{
    protected array $props = ['isChecked'];

    protected array $casts = [
        'isChecked' => 'boolean',
    ];

    protected bool $isChecked = false;

    public function render(): string
    {
        $data = [
            'id'    => $this->value,
            'name'  => $this->name,
            'class' => 'color-radio-btn',
        ];

        if ($this->isRequired) {
            $data['required'] = 'required';
        }

        $radioInput = form_radio(
            $data,
            $this->value,
            old($this->name) ? old($this->name) === $this->value : $this->isChecked,
        );

        return <<<HTML
            <div {$this->getStringifiedAttributes()}>
                {$radioInput}
                <label for="{$this->value}" title="{$this->slot}" data-tooltip="bottom"></label>
            </div>
        HTML;
    }
}
