<?php

declare(strict_types=1);

namespace App\View\Components;

use ViewComponents\Component;

class Icon extends Component
{
    public string $glyph = '';

    public function render(): string
    {
        $svgContents = file_get_contents('assets/icons/' . $this->glyph . '.svg');

        if ($svgContents) {
            if ($this->attributes['class'] !== '') {
                $svgContents = str_replace('<svg', '<svg class="' . $this->attributes['class'] . '"', $svgContents);
            }

            return $svgContents;
        }

        return '□';
    }
}
