<?php

declare(strict_types=1);

namespace App\Views\Components;

use ViewComponents\Component;

class ReadMore extends Component
{
    public function render(): string
    {
        $readMoreLabel = lang('Common.read_more');
        $readLessLabel = lang('Common.read_less');
        return <<<HTML
            <div class="read-more {$this->class}" style="--line-clamp: 3">
                <input id="read-more-checkbox_{$this->id}" type="checkbox" class="read-more__checkbox" aria-hidden="true">
                <div class="mb-2 read-more__text">{$this->slot}</div>
                <label for="read-more-checkbox_{$this->id}" class="read-more__label" data-read-more="{$readMoreLabel}" data-read-less="{$readLessLabel}" aria-hidden="true"></label>
            </div>
        HTML;
    }
}
