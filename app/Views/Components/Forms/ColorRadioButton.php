<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use Override;

class ColorRadioButton extends FormComponent
{
    protected array $props = ['isSelected'];

    protected array $casts = [
        'isSelected' => 'boolean',
    ];

    protected bool $isSelected = false;

    #[Override]
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
            old($this->name) ? old($this->name) === $this->value : $this->isSelected,
        );

        return <<<HTML
            <div {$this->getStringifiedAttributes()}>
                {$radioInput}
                <label for="{$this->value}" title="{$this->slot}" data-tooltip="bottom"></label>
            </div>
        HTML;
    }
}
