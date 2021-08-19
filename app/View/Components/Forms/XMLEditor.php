<?php

declare(strict_types=1);

namespace App\View\Components\Forms;

use ViewComponents\Component;

class XMLEditor extends Component
{
    protected string $content = '';

    /**
     * @var array<string, string>
     */
    protected array $attributes = [
        'slot' => 'textarea',
        'rows' => '5',
        'class' => 'textarea',
    ];

    public function render(): string
    {
        $textarea = form_textarea($this->attributes, $this->content);

        return <<<CODE_SAMPLE
            <xml-editor>{$textarea}</time-ago>
        CODE_SAMPLE;
    }
}
