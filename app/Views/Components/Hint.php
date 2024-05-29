<?php

declare(strict_types=1);

namespace App\Views\Components;

use Override;
use ViewComponents\Component;

class Hint extends Component
{
    protected array $attributes = [
        'data-tooltip' => 'bottom',
        'tabindex'     => '0',
    ];

    #[Override]
    public function render(): string
    {
        $this->attributes['title'] = $this->slot;

        $this->mergeClass('inline-block align-middle opacity-75');

        $icon = icon('question-fill');

        return <<<HTML
            <span {$this->getStringifiedAttributes()}>{$icon}</span>
        HTML;
    }
}
