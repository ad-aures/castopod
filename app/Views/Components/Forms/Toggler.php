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

    /**
     * @var 'base'|'small
     */
    protected string $size = 'base';

    protected string $hint = '';

    protected bool $isChecked = false;

    public function render(): string
    {
        $sizeClass = match ($this->size) {
            'small' => 'form-switch-slider form-switch-slider--small',
            default => 'form-switch-slider',
        };

        $this->mergeClass('relative justify-between inline-flex items-center gap-x-2');

        $checkbox = form_checkbox([
            'class' => 'form-switch',
        ], 'yes', old($this->name) === 'yes' ? true : $this->isChecked);

        $hint = $this->hint === '' ? '' : (new Hint([
            'class' => 'ml-1',
            'slot'  => $this->hint,
        ]))->render();

        return <<<HTML
            <label {$this->getStringifiedAttributes()}>
                <span class="">{$this->slot}{$hint}</span>
                {$checkbox}
                <span class="{$sizeClass}"></span>
            </label>
        HTML;
    }
}
