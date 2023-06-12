<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class Select extends FormComponent
{
    /**
     * @var array<string, string>
     */
    protected array $options = [];

    protected string $selected = '';

    public function setOptions(string $value): void
    {
        $this->options = json_decode(htmlspecialchars_decode($value), true);
    }

    public function render(): string
    {
        $defaultAttributes = [
            'class'                => 'focus:border-contrast focus:ring-accent border-3 rounded-lg bg-elevated border-contrast ' . $this->class,
            'data-class'           => $this->class,
            'data-select-text'     => lang('Common.forms.multiSelect.selectText'),
            'data-loading-text'    => lang('Common.forms.multiSelect.loadingText'),
            'data-no-results-text' => lang('Common.forms.multiSelect.noResultsText'),
            'data-no-choices-text' => lang('Common.forms.multiSelect.noChoicesText'),
            'data-max-item-text'   => lang('Common.forms.multiSelect.maxItemText'),
        ];
        $extra = array_merge($this->attributes, $defaultAttributes);

        return form_dropdown($this->name, $this->options, old($this->name, $this->selected !== '' ? [$this->selected] : []), $extra);
    }
}
