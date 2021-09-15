<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class XMLEditor extends FormComponent
{
    /**
     * @var array<string, string>
     */
    protected array $attributes = [
        'rows' => '5',
        'class' => 'textarea',
    ];

    public function render(): string
    {
        $content = $this->slot;
        $this->attributes['slot'] = 'textarea';
        $textarea = form_textarea($this->attributes, $content);

        return <<<HTML
            <xml-editor>{$textarea}</time-ago>
        HTML;
    }
}
