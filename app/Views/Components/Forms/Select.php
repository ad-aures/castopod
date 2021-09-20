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
        $this->options = json_decode(html_entity_decode($value), true);
    }

    public function render(): string
    {
        $defaultAttributes = [
            'class' => 'focus:border-black focus:ring-2 focus:ring-pine-500 focus:ring-offset-2 focus:ring-offset-pine-100 border-3 rounded-lg border-black ' . $this->class,
            'data-class' => $this->class,
        ];
        $extra = array_merge($this->attributes, $defaultAttributes);

        return form_dropdown($this->name, $this->options, old($this->name, $this->selected !== '' ? [$this->selected] : []), $extra);
    }
}
