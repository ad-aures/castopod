<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class Helper extends FormComponent
{
    /**
     * @var 'default'|'error'
     */
    protected string $type = 'default';

    public function render(): string
    {
        $class = 'text-skin-muted';

        return <<<HTML
            <small id="{$this->id}" class="{$class} {$this->class}">{$this->slot}</small>
        HTML;
    }
}
