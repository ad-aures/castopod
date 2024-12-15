<?php

declare(strict_types=1);

namespace App\Views\Components\Charts;

use Override;
use ViewComponents\Component;

class ChartsComponent extends Component
{
    protected array $props = ['title', 'subtitle', 'dataUrl', 'type'];

    protected string $title;

    protected string $subtitle = '';

    protected string $dataUrl;

    protected string $type;

    #[Override]
    public function render(): string
    {
        $subtitleBlock = '';
        if ($this->subtitle !== '') {
            $subtitleBlock = '<p class="px-6 -mt-4 text-sm text-skin-muted">' . $this->subtitle . '</p>';
        }

        $this->mergeClass('bg-elevated border-3 rounded-xl border-subtle');

        return <<<HTML
            <div {$this->getStringifiedAttributes()}>
                <h2 class="px-6 py-4 text-xl">{$this->title}</h2>
                {$subtitleBlock}
                <div class="w-full h-[500px]" data-chart-type="{$this->type}" data-chart-url="{$this->dataUrl}"></div>
            </div>
        HTML;
    }
}
