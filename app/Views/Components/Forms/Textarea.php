<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use Override;

class Textarea extends FormComponent
{
    public function setValue(string $value): void
    {
        $this->value = htmlspecialchars_decode($value);
    }

    #[Override]
    public function render(): string
    {
        $this->mergeClass('bg-elevated w-full rounded-lg border-3 border-contrast focus:border-contrast focus-within:ring-accent transition');

        $this->attributes['id'] = $this->id;

        $textarea = form_textarea($this->attributes, $this->getValue());

        return <<<HTML
            {$textarea}
        HTML;
    }
}
