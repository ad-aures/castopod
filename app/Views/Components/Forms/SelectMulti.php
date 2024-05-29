<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use Override;

class SelectMulti extends FormComponent
{
    protected array $props = ['options', 'defaultValue'];

    protected array $casts = [
        'value'        => 'array',
        'options'      => 'array',
        'defaultValue' => 'array',
    ];

    /**
     * @var array<string, string>
     */
    protected array $options = [];

    /**
     * @var list<string>
     */
    protected array $defaultValue = [];

    #[Override]
    public function render(): string
    {
        $this->mergeClass('w-full bg-elevated border-3 border-contrast rounded-lg relative');

        $defaultAttributes = [
            'multiple'             => 'multiple',
            'data-select-text'     => lang('Common.forms.multiSelect.selectText'),
            'data-loading-text'    => lang('Common.forms.multiSelect.loadingText'),
            'data-no-results-text' => lang('Common.forms.multiSelect.noResultsText'),
            'data-no-choices-text' => lang('Common.forms.multiSelect.noChoicesText'),
            'data-max-item-text'   => lang('Common.forms.multiSelect.maxItemText'),
        ];
        $this->attributes = [...$defaultAttributes, ...$this->attributes];

        $options = '';
        $selected = $this->value ?? $this->defaultValue;
        foreach ($this->options as $option) {
            $options .= '<option value="' . $option['value'] . '"' . (in_array($option['value'], $selected, true) ? ' selected' : '') . '>' . $option['label'] . '</option>';
        }

        $this->attributes['name'] = $this->name . '[]';

        return <<<HTML
        <select {$this->getStringifiedAttributes()}>{$options}</select>
        HTML;
    }
}
