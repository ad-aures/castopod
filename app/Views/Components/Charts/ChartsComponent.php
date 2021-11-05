<?php

declare(strict_types=1);

namespace App\Views\Components\Charts;

use ViewComponents\Component;

class ChartsComponent extends Component
{
    protected string $title = '';

    protected string $dataUrl = '';

    protected string $type = '';

    public function render(): string
    {
        return <<<HTML
            <div class="bg-elevated border-3 rounded-xl border-subtle {$this->class}">
                <h2 class="px-6 py-4 text-xl">{$this->title}</h2>
                <div class="w-full h-[500px]" data-chart-type="{$this->type}" data-chart-url="{$this->dataUrl}"></div>
            </div>
        HTML;
    }
}
