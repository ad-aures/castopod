<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class Checkbox extends FormComponent
{
    protected ?string $hint = null;

    protected bool $isChecked = false;

    public function setIsChecked(string $value): void
    {
        $this->isChecked = $value === 'true';
    }

    public function render(): string
    {
        $checkboxInput = form_checkbox(
            [
                'id' => $this->value,
                'name' => $this->name,
                'class' => 'form-checkbox text-pine-500 border-black border-3 focus:ring-2 focus:ring-pine-500 focus:ring-offset-2 focus:ring-offset-pine-100 w-6 h-6',
            ],
            'yes',
            old($this->name) ? old($this->name) === $this->value : $this->isChecked,
        );

        $hint = $this->hint === null ? '' : hint_tooltip($this->hint, 'ml-1');

        return <<<HTML
            <label class="leading-8">
                {$checkboxInput}
                <span class="ml-2">{$this->slot}{$hint}</label>
            </label>
        HTML;
    }
}
