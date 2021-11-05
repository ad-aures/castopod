<?php

declare(strict_types=1);

namespace App\Views\Components;

use ViewComponents\Component;

class IconButton extends Component
{
    public string $glyph = '';

    public function render(): string
    {
        $attributes = [
            'isSquared' => 'true',
            'title' => $this->slot,
            'data-tooltip' => 'bottom',
        ];

        $attributes = array_merge($attributes, $this->attributes);

        $attributes['slot'] = icon($this->glyph);

        unset($attributes['glyph']);

        $iconButton = new Button($attributes);
        return $iconButton->render();
    }
}
