<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use App\Views\Components\Hint;
use Override;

class Toggler extends FormComponent
{
    protected array $props = ['size', 'hint', 'helper', 'isChecked'];

    protected array $casts = [
        'isChecked' => 'boolean',
    ];

    protected string $hint = '';

    protected string $helper = '';

    protected bool $isChecked = false;

    #[Override]
    public function render(): string
    {
        $this->mergeClass('relative justify-between inline-flex items-start gap-x-2');

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

        $helperText = '';
        if ($this->helper !== '') {
            $helperId = $this->name . 'Help';
            $helperText = (new Helper([
                'id'    => $helperId,
                'slot'  => $this->helper,
                'class' => '-mt-1',
            ]))->render();
            $this->attributes['aria-describedby'] = $helperId;
        }

        return <<<HTML
            <label {$this->getStringifiedAttributes()}>
                <div class="flex flex-col">
                    <span>{$this->slot}{$hint}</span>
                    {$helperText}
                </div>
                {$checkbox}
                <span class="form-switch-slider"></span>
            </label>
        HTML;
    }
}
