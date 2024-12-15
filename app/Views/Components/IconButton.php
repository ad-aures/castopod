<?php

declare(strict_types=1);

namespace App\Views\Components;

class IconButton extends Button
{
    protected array $props = ['glyph'];

    protected string $glyph;

    public function __construct(array $attributes)
    {
        $iconButtonAttributes = [
            'isSquared'    => 'true',
            'title'        => $attributes['slot'],
            'data-tooltip' => 'bottom',
        ];

        $allAttributes = [...$attributes, ...$iconButtonAttributes];

        parent::__construct($allAttributes);

        $glyphSizeClass = match ($this->size) {
            'small' => 'text-sm',
            'large' => 'text-2xl',
            default => 'text-lg',
        };

        $this->slot = (string) icon($this->glyph, [
            'class' => $glyphSizeClass,
        ]);
    }
}
