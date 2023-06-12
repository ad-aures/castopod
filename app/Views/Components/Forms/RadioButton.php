<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class RadioButton extends FormComponent
{
    protected bool $isChecked = false;

    protected ?string $hint = null;

    public function setIsChecked(string $value): void
    {
        $this->isChecked = $value === 'true';
    }

    public function render(): string
    {
        $data = [
            'id'    => $this->value,
            'name'  => $this->name,
            'class' => 'form-radio-btn bg-elevated',
        ];

        if ($this->required) {
            $data['required'] = 'required';
        }

        $radioInput = form_radio(
            $data,
            $this->value,
            old($this->name) ? old($this->name) === $this->value : $this->isChecked,
        );

        $hint = $this->hint ? hint_tooltip($this->hint, 'ml-1 text-base') : '';

        return <<<HTML
            <div class="{$this->class}">
                {$radioInput}
                <label for="{$this->value}">{$this->slot}{$hint}</label>
            </div>
        HTML;
    }
}
