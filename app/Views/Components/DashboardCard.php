<?php

declare(strict_types=1);

namespace App\Views\Components;

use ViewComponents\Component;

class DashboardCard extends Component
{
    protected ?string $href = null;

    protected string $glyph;

    protected string $title;

    protected string $subtitle;

    public function setSubtitle(string $value): void
    {
        $this->subtitle = html_entity_decode($value);
    }

    public function render(): string
    {
        $glyph = (string) icon($this->glyph, [
            'class' => 'flex-shrink-0 bg-base rounded-full w-8 h-8 p-2 text-accent-base',
        ]);

        if ($this->href !== null && $this->href !== '') {
            $chevronRight = (string) icon('arrow-right-s-fill');
            $viewLang = lang('Common.view');
            return <<<HTML
                <a href="{$this->href}" class="flex items-center justify-between w-full gap-4 p-4 lg:max-w-sm lg:flex-col xl:flex-row bg-elevated focus:ring-accent rounded-xl border-3 border-subtle group">
                    <div class="flex items-start">{$glyph}<div class="flex flex-col ml-2"><div class="flex items-center"><span class="text-xs font-semibold leading-loose tracking-wider uppercase">{$this->title}</span><div class="inline-flex items-center ml-4 transition -translate-x-full group-hover:translate-x-0 group-focus:translate-x-0"><span class="-ml-2 text-xs lowercase transition opacity-0 group-hover:opacity-100 group-focus:opacity-100">{$viewLang}</span>{$chevronRight}</div></div><p class="text-xs">{$this->subtitle}</p></div></div>
                    <div class="text-5xl font-bold">{$this->slot}</div>
                </a>
            HTML;
        }

        return <<<HTML
            <div class="flex items-center justify-between w-full gap-4 p-4 lg:max-w-sm lg:flex-col xl:flex-row bg-elevated rounded-xl border-3 border-subtle">
                <div class="flex items-start">{$glyph}<div class="flex flex-col ml-2"><span class="text-xs font-semibold leading-loose tracking-wider uppercase">{$this->title}</span><p class="text-xs">{$this->subtitle}</p></div></div>
                <div class="text-5xl font-bold">{$this->slot}</div>
            </div>
        HTML;
    }
}
