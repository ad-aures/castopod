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
        $attributes = [
            'id'    => $this->value,
            'name'  => $this->name,
            'class' => 'form-checkbox bg-elevated text-accent-base border-contrast border-3 focus:ring-accent w-6 h-6',
        ];
        if ($this->required) {
            $attributes['required'] = 'required';
        }
        $checkboxInput = form_checkbox(
            $attributes,
            'yes',
            old($this->name) ? old($this->name) === $this->value : $this->isChecked,
        );

        $hint = $this->hint === null ? '' : hint_tooltip($this->hint, 'ml-1');

        return <<<HTML
            <label class="inline-flex items-center {$this->class}">{$checkboxInput}<span class="ml-2">{$this->slot}{$hint}</span></label>
        HTML;
    }
}
