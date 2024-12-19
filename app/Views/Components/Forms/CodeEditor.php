<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use Override;

class CodeEditor extends FormComponent
{
    protected array $props = ['content', 'lang'];

    /**
     * @var array<string, string>
     */
    protected array $attributes = [
        'rows'  => '6',
        'class' => 'textarea',
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
