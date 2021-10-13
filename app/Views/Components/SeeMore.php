<?php

declare(strict_types=1);

namespace App\Views\Components;

use ViewComponents\Component;

class SeeMore extends Component
{
    public function render(): string
    {
        $seeMoreLabel = lang('Common.see_more');
        $seeLessLabel = lang('Common.see_less');
        return <<<HTML
            <div class="see-more" style="--line-clamp: 3">
                <input id="see-more-checkbox" type="checkbox" class="see-more__checkbox" aria-hidden="true">
                <div class="mb-2 see-more__content {$this->class}"><div class="see-more_content-fade"></div>{$this->slot}</div>
                <label for="see-more-checkbox" class="see-more__label" data-see-more="{$seeMoreLabel}" data-see-less="{$seeLessLabel}" aria-hidden="true"></label>
            </div>
        HTML;
    }
}
