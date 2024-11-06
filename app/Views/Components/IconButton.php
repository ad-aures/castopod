<?php

declare(strict_types=1);

namespace App\Views\Components;

class IconButton extends Button
{
    public string $glyph = '';

    public function __construct(array $attributes)
    {
        $iconButtonAttributes = [
            'isSquared'    => 'true',
            'title'        => $attributes['slot'],
            'data-tooltip' => 'bottom',
        ];

        $glyphSize = [
            'small' => 'text-sm',
            'base'  => 'text-lg',
            'large' => 'text-2xl',
        ];

        $allAttributes = [...$attributes, ...$iconButtonAttributes];

        parent::__construct($allAttributes);

        $this->slot = (string) icon($this->glyph, [
            'class' => $glyphSize[$this->size],
        ]);
    }
}
