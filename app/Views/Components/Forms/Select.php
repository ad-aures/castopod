<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use Override;

class Select extends FormComponent
{
    protected array $props = ['options', 'defaultValue'];

    protected array $casts = [
        'options' => 'array',
    ];

    /**
     * @var array<array<string, string>>
     */
    protected array $options = [];

    protected string $defaultValue = '';

    #[Override]
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
        $this->attributes = [...$defaultAttributes, ...$this->attributes];

        $options = '';
        $selected = $this->value ?? $this->defaultValue;
        foreach ($this->options as $option) {
            $options .= '<option ' . (array_key_exists('hint', $option) ? 'data-label-description="' . $option['hint'] . '" ' : '') . 'value="' . $option['value'] . '"' . ($option['value'] === $selected ? ' selected' : '') . '>' . $option['label'] . '</option>';
        }

        $this->attributes['name'] = $this->name;

        return <<<HTML
        <select {$this->getStringifiedAttributes()}>{$options}</select>
        HTML;
    }
}
