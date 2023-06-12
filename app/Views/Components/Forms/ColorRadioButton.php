<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class ColorRadioButton extends FormComponent
{
    protected bool $isChecked = false;

    protected string $style = '';

    public function setIsChecked(string $value): void
    {
        $this->isChecked = $value === 'true';
    }

    public function render(): string
    {
        $data = [
            'id'    => $this->value,
            'name'  => $this->name,
            'class' => 'color-radio-btn',
        ];

        if ($this->required) {
            $data['required'] = 'required';
        }

        $radioInput = form_radio(
            $data,
            $this->value,
            old($this->name) ? old($this->name) === $this->value : $this->isChecked,
        );

        return <<<HTML
            <div class="{$this->class}" style="{$this->style}">
                {$radioInput}
                <label for="{$this->value}" title="{$this->slot}" data-tooltip="bottom"></label>
            </div>
        HTML;
    }
}
