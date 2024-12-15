<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use Override;

class XMLEditor extends FormComponent
{
    protected array $props = ['content'];

    /**
     * @var array<string, string>
     */
    protected array $attributes = [
        'rows'  => '5',
        'class' => 'textarea',
    ];

    protected string $content = '';

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
            <xml-editor>{$textarea}</xml-editor>
        HTML;
    }
}
