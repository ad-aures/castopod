<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class Textarea extends FormComponent
{
    public function setValue(?string $value): void
    {
        if ($value) {
            $this->value = html_entity_decode($value);
        }
    }

    public function render(): string
    {
        unset($this->attributes['value']);

        $this->attributes['class'] = 'focus:border-black focus:ring-2 focus:ring-pine-500 focus:ring-offset-2 focus:ring-offset-pine-100 rounded-lg border-3 border-black ' . $this->class;

        $textarea = form_textarea(
            $this->attributes,
            old($this->name, $this->value ?? '', false)
        );

        return <<<HTML
            {$textarea}
        HTML;
    }
}
