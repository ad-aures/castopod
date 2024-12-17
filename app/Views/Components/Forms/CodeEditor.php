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

    protected string $content = '';

    protected string $lang = '';

    public function setContent(string $value): void
    {
        $this->content = htmlspecialchars_decode($value);
    }

    #[Override]
    public function render(): string
    {
        $this->attributes['slot'] = 'textarea';
        $textarea = form_textarea($this->attributes, $this->content);

        return <<<HTML
            <code-editor lang="{$this->lang}">{$textarea}</code-editor>
        HTML;
    }
}
