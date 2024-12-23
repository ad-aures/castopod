<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use Override;

class CodeEditor extends FormComponent
{
    protected array $props = ['content', 'lang'];

    protected array $attributes = [
        'rows'  => '6',
        'class' => 'bg-elevated w-full rounded-lg border-3 border-contrast focus:border-contrast focus-within:ring-accent transition',
    ];

    protected string $lang = '';

    public function setValue(string $value): void
    {
        $this->value = htmlspecialchars_decode($value);
    }

    #[Override]
    public function render(): string
    {
        $this->attributes['slot'] = 'textarea';
        $textarea = form_textarea($this->attributes, $this->getValue());

        return <<<HTML
            <code-editor lang="{$this->lang}">{$textarea}</code-editor>
        HTML;
    }
}
