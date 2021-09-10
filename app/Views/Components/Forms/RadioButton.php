<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

/**
 * Form Checkbox Switch
 *
 * Abstracts form_label to stylize it as a switch toggle
 */
class RadioButton extends FormComponent
{
    protected bool $isChecked = false;

    public function setIsChecked(string $value): void
    {
        $this->isChecked = $value === 'true';
    }

    public function render(): string
    {
        $radioInput = form_radio(
            [
                'id' => $this->value,
                'name' => $this->name,
                'class' => 'form-radio-btn',
            ],
            $this->value,
            old($this->name) ? old($this->name) === $this->value : $this->isChecked,
        );

        return <<<HTML
            <div>
                {$radioInput}
                <label for="{$this->value}">{$this->slot}</label>
            </div>
        HTML;
    }
}
