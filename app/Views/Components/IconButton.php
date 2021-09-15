<?php

declare(strict_types=1);

namespace App\Views\Components;

use ViewComponents\Component;

class IconButton extends Component
{
    public string $glyph = '';

    public function render(): string
    {
        $attributes = stringify_attributes($this->attributes);

        return <<<HTML
            <Button isSquared="true" title="{$this->slot}" data-toggle="tooltip" data-placement="bottom" {$attributes}><Icon glyph="{$this->glyph}" /></Button>
        HTML;
    }
}
