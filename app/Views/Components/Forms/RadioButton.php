<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use App\Views\Components\Hint;
use Override;

class RadioButton extends FormComponent
{
    protected array $props = ['isChecked', 'hint'];

    protected array $casts = [
        'isSelected' => 'boolean',
    ];

    protected bool $isSelected = false;

    protected string $hint = '';

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

        $radioInput = form_radio(
            $data,
            $this->value,
            old($this->name) ? old($this->name) === $this->value : $this->isSelected,
        );

        $hint = $this->hint === '' ? '' : (new Hint([
            'class' => 'ml-1 text-base',
            'slot'  => $this->hint,
        ]))->render();

        return <<<HTML
            <div {$this->getStringifiedAttributes()}">
                {$radioInput}
                <label for="{$this->value}">{$this->slot}{$hint}</label>
            </div>
        HTML;
    }
}
