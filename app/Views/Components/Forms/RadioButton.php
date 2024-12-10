<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use Override;

class RadioButton extends FormComponent
{
    protected array $props = ['isChecked', 'hint'];

    protected array $casts = [
        'isSelected' => 'boolean',
    ];

    protected bool $isSelected = false;

    protected string $description = '';

    #[Override]
    public function render(): string
    {
        $data = [
            'id'    => $this->value,
            'name'  => $this->name,
            'class' => 'form-radio-btn bg-elevated',
        ];

        if ($this->isRequired) {
            $data['required'] = 'required';
        }

        $this->mergeClass('relative w-full');

        $descriptionText = '';
        if ($this->description !== '') {
            $describerId = $this->name . 'Help';
            $descriptionText = <<<HTML
                <span id="{$describerId}" class="form-radio-btn-description">{$this->description}</span>
            HTML;
            $data['aria-describedby'] = $describerId;
        }

        $radioInput = form_radio(
            $data,
            $this->value,
            old($this->name) ? old($this->name) === $this->value : $this->isSelected,
        );

        return <<<HTML
            <div {$this->getStringifiedAttributes()}">
                {$radioInput}
                <label for="{$this->value}">
                    <span>{$this->slot}</span>
                    {$descriptionText}
                </label>
            </div>
        HTML;
    }
}
