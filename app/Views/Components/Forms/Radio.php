<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class Radio extends FormComponent
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
                'class' => 'text-pine-500 border-black border-3 focus:ring-castopod w-6 h-6',
            ],
            $this->value,
            old($this->name) ? old($this->name) === $this->value : $this->isChecked,
        );

        return <<<HTML
            <label class="inline-flex items-center {$this->class}">{$radioInput}<span class="ml-2">{$this->slot}</span></label>
        HTML;
    }
}
