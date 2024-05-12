<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use App\Views\Components\Hint;

class Toggler extends FormComponent
{
    protected array $props = ['size', 'hint', 'isChecked'];

    protected array $casts = [
        'isChecked' => 'boolean',
    ];

    protected string $hint = '';

    protected bool $isChecked = false;

    public function render(): string
    {
        $this->mergeClass('relative justify-between inline-flex items-center gap-x-2');

        $checkbox = form_checkbox(
            [
                'id'    => $this->id,
                'name'  => $this->name,
                'class' => 'form-switch',
            ],
            'yes',
            old($this->name) ? old($this->name) === 'yes' : $this->isChecked
        );

        $hint = $this->hint === '' ? '' : (new Hint([
            'class' => 'ml-1',
            'slot'  => $this->hint,
        ]))->render();

        return <<<HTML
            <label {$this->getStringifiedAttributes()}>
                <span>{$this->slot}{$hint}</span>
                {$checkbox}
                <span class="form-switch-slider"></span>
            </label>
        HTML;
    }
}
