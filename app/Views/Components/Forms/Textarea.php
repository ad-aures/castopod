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
        $this->mergeClass('bg-elevated w-full rounded-lg border-3 border-contrast focus:border-contrast focus-within:ring-accent');

        $this->attributes['id'] = $this->id;

        $textarea = form_textarea(
            $this->attributes,
            old($this->name, $this->value ?? '', false)
        );

        return <<<HTML
            {$textarea}
        HTML;
    }
}
