<?php

declare(strict_types=1);

namespace App\Views\Components;

use Exception;
use ViewComponents\Component;

class Icon extends Component
{
    public string $glyph = '';

    public function render(): string
    {
        try {
            $svgContents = file_get_contents('assets/icons/' . $this->glyph . '.svg');
        } catch (Exception) {
            return '□';
        }

        if ($this->attributes['class'] !== '') {
            $svgContents = str_replace('<svg', '<svg class="' . $this->attributes['class'] . '"', $svgContents);
        }

        return $svgContents;
    }
}
