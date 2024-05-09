<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class MultiSelect extends FormComponent
{
    protected array $props = ['options', 'selected'];

    protected array $casts = [
        'options'  => 'array',
        'selected' => 'array',
    ];

    /**
     * @var array<string, string>
     */
    protected array $options = [];

    /**
     * @var string[]
     */
    protected array $selected = [];

    public function render(): string
    {
        $this->mergeClass('w-full bg-elevated border-3 border-contrast rounded-lg');

        $defaultAttributes = [
            'data-class'           => $this->attributes['class'],
            'multiple'             => 'multiple',
            'data-select-text'     => lang('Common.forms.multiSelect.selectText'),
            'data-loading-text'    => lang('Common.forms.multiSelect.loadingText'),
            'data-no-results-text' => lang('Common.forms.multiSelect.noResultsText'),
            'data-no-choices-text' => lang('Common.forms.multiSelect.noChoicesText'),
            'data-max-item-text'   => lang('Common.forms.multiSelect.maxItemText'),
        ];
        $extra = [...$defaultAttributes, ...$this->attributes];

        return form_dropdown($this->name, $this->options, $this->selected, $extra);
    }
}
