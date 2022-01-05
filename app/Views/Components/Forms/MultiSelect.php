<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class MultiSelect extends FormComponent
{
    /**
     * @var array<string, string>
     */
    protected array $options = [];

    /**
     * @var string[]
     */
    protected array $selected = [];

    public function setOptions(string $value): void
    {
        $this->options = json_decode(htmlspecialchars_decode($value), true);
    }

    public function setSelected(string $selected): void
    {
        $this->selected = json_decode(htmlspecialchars_decode($selected), true);
    }

    public function render(): string
    {
        $defaultAttributes = [
            'data-class' => $this->attributes['class'],
            'multiple' => 'multiple',
            'data-select-text' => lang('Common.forms.multiSelect.selectText'),
            'data-loading-text' => lang('Common.forms.multiSelect.loadingText'),
            'data-no-results-text' => lang('Common.forms.multiSelect.noResultsText'),
            'data-no-choices-text' => lang('Common.forms.multiSelect.noChoicesText'),
            'data-max-item-text' => lang('Common.forms.multiSelect.maxItemText'),
        ];
        $this->attributes['class'] .= ' bg-elevated border-3 border-contrast rounded-lg';
        $extra = array_merge($defaultAttributes, $this->attributes);

        return form_dropdown($this->name, $this->options, $this->selected, $extra);
    }
}
