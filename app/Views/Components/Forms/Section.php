<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use ViewComponents\Component;

class Section extends Component
{
    protected array $props = ['title', 'subtitle'];

    protected string $title;

    protected string $subtitle = '';

    public function render(): string
    {
        $subtitle = $this->subtitle === '' ? '' : '<p class="text-sm text-skin-muted">' . $this->subtitle . '</p>';

        $this->mergeClass('w-full p-8 bg-elevated border-3 flex flex-col items-start border-subtle rounded-xl');

        return <<<HTML
            <fieldset {$this->getStringifiedAttributes()}>
                <x-Heading tagName="legend" class="float-left">{$this->title}</x-Heading>
                {$subtitle}
                <div class="flex flex-col w-0 min-w-full gap-4 py-4">{$this->slot}</div>
            </fieldset>
        HTML;
    }
}
