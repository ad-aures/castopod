<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class Select extends FormComponent
{
    protected array $props = ['options', 'selected'];

    protected array $casts = [
        'options' => 'array',
    ];

    /**
     * @var array<string, string>
     */
    protected array $options = [];

    protected string $selected = '';

    public function render(): string
    {
        $this->mergeClass('w-full focus:border-contrast border-3 rounded-lg bg-elevated border-contrast');
        $defaultAttributes = [
            'data-select-text'     => lang('Common.forms.multiSelect.selectText'),
            'data-loading-text'    => lang('Common.forms.multiSelect.loadingText'),
            'data-no-results-text' => lang('Common.forms.multiSelect.noResultsText'),
            'data-no-choices-text' => lang('Common.forms.multiSelect.noChoicesText'),
            'data-max-item-text'   => lang('Common.forms.multiSelect.maxItemText'),
        ];
        $extra = [...$defaultAttributes, ...$this->attributes];

        return form_dropdown($this->name, $this->options, old($this->name, $this->selected !== '' ? [$this->selected] : []), $extra);
    }
}
