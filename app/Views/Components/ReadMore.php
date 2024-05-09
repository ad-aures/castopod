<?php

declare(strict_types=1);

namespace App\Views\Components;

use ViewComponents\Component;

class ReadMore extends Component
{
    protected array $props = ['id'];

    protected string $id;

    public function render(): string
    {
        $readMoreLabel = lang('Common.read_more');
        $readLessLabel = lang('Common.read_less');

        $this->mergeClass('read-more');
        $this->attributes['style'] = '--line-clamp: 3';

        return <<<HTML
            <div {$this->getStringifiedAttributes()}>
                <input id="read-more-checkbox_{$this->id}" type="checkbox" class="read-more__checkbox" aria-hidden="true">
                <div class="read-more__text">{$this->slot}</div>
                <label for="read-more-checkbox_{$this->id}" class="mt-2 read-more__label" data-read-more="{$readMoreLabel}" data-read-less="{$readLessLabel}" aria-hidden="true"></label>
            </div>
        HTML;
    }
}
