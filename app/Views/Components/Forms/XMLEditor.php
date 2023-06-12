<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class XMLEditor extends FormComponent
{
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

    public function render(): string
    {
        $this->attributes['slot'] = 'textarea';
        $textarea = form_textarea($this->attributes, $this->content);

        return <<<HTML
            <xml-editor>{$textarea}</time-ago>
        HTML;
    }
}
