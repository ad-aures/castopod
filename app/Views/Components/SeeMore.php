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

        $this->mergeClass('see-more');
        $this->attributes['styles'] = '--content-height: 10rem';

        return <<<HTML
            <div {$this->getStringifiedAttributes()}>
                <input id="see-more-checkbox" type="checkbox" class="see-more__checkbox" aria-hidden="true">
                <div class="see-more__content"><div class="see-more_content-fade"></div>{$this->slot}</div>
                <label for="see-more-checkbox" class="mt-2 see-more__label" data-see-more="{$seeMoreLabel}" data-see-less="{$seeLessLabel}" aria-hidden="true"></label>
            </div>
        HTML;
    }
}
