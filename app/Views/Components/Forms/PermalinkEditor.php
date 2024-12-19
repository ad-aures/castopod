<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use Override;

class PermalinkEditor extends FormComponent
{
    protected array $props = ['label', 'prefix', 'permalinkBase'];

    protected string $label = '';

    protected string $prefix = '';

    protected string $permalinkBase = '';

    #[Override]
    public function render(): string
    {
        $this->mergeClass('flex-1 text-xs border-contrast rounded-lg focus:border-contrast border-3 focus-within:ring-accent transition');

        $this->attributes['slot'] = 'slug-input';
        $input = form_input($this->attributes, $this->getValue());

        $editLabel = lang('Common.edit');
        $copyLabel = lang('Common.copy');
        $copiedLabel = lang('Common.copied');

        return <<<HTML
            <div>
                <x-Forms.Label for="{$this->id}">{$this->label}</x-Forms.Label>
                <permalink-edit class="inline-flex items-center w-full text-xs" edit-label="{$editLabel}" copy-label="{$copyLabel}" copied-label="{$copiedLabel}" permalink-base="{$this->permalinkBase}">
                    <span slot="domain">{$this->prefix}</span>
                    {$input}
                </permalink-edit>
            </div>
        HTML;
    }
}
