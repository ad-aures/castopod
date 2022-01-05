<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class Textarea extends FormComponent
{
    public function setValue(?string $value): void
    {
        if ($value) {
            $this->value = htmlspecialchars_decode($value);
        }
    }

    public function render(): string
    {
        unset($this->attributes['value']);

        $this->attributes['class'] = 'bg-elevated w-full focus:border-contrast focus:ring-accent rounded-lg border-3 border-contrast ' . $this->class;

        $textarea = form_textarea(
            $this->attributes,
            old($this->name, $this->value ?? '', false)
        );

        return <<<HTML
            {$textarea}
        HTML;
    }
}
