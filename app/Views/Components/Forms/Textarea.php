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

        $this->attributes['class'] = 'w-full focus:border-black focus:ring-castopod rounded-lg border-3 border-black ' . $this->class;

        $textarea = form_textarea(
            $this->attributes,
            old($this->name, $this->value ?? '', false)
        );

        return <<<HTML
            {$textarea}
        HTML;
    }
}
