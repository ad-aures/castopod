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
        // dd(json_decode(html_entity_decode(html_entity_decode($value)), true));
        $this->options = json_decode(html_entity_decode($value), true);
    }

    public function render(): string
    {
        $defaultAttributes = [
            'data-class' => 'border-3 rounded-lg ' . $this->class,
        ];
        $extra = array_merge($defaultAttributes, $this->attributes);

        return form_dropdown($this->name, $this->options, $this->selected !== '' ? [$this->selected] : [], $extra);
    }
}
