<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use App\Views\Components\Hint;
use Override;

class Checkbox extends FormComponent
{
    protected array $props = ['hint', 'helper', 'isChecked'];

    protected array $casts = [
        'isChecked' => 'boolean',
    ];

    protected string $hint = '';

    protected string $helper = '';

    protected bool $isChecked = false;

    #[Override]
    public function render(): string
    {
        $checkboxInput = form_checkbox(
            [
                'id'    => $this->id,
                'name'  => $this->name,
                'class' => 'form-checkbox bg-elevated text-accent-base border-contrast border-3 w-6 h-6',
            ],
            'yes',
            old($this->name) ? old($this->name) === 'yes' : $this->isChecked,
        );

        $hint = $this->hint === '' ? '' : (new Hint([
            'class' => 'ml-1',
            'slot'  => $this->hint,
        ]))->render();

        $this->mergeClass('inline-flex items-start gap-x-2');

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
            <label {$this->getStringifiedAttributes()}>{$checkboxInput}
                <div class="flex flex-col">
                    <span>{$this->slot}{$hint}</span>
                    {$helperText}
                </div>
            </label>
        HTML;
    }
}
