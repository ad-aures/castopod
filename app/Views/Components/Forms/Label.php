<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use App\Views\Components\Hint;
use Override;
use ViewComponents\Component;

class Label extends Component
{
    protected array $props = ['for', 'hint', 'isOptional'];

    protected array $casts = [
        'isOptional' => 'boolean',
    ];

    protected string $for;

    protected string $hint = '';

    protected bool $isOptional = false;

    #[Override]
    public function render(): string
    {
        $this->mergeClass('text-sm font-semibold');

        $optionalText = $this->isOptional ? '<small class="ml-1 font-normal lowercase">(' .
        lang('Common.optional') .
        ')</small>' : '';

        $hint = $this->hint === '' ? '' : new Hint([
            'class' => 'ml-1',
            'slot'  => $this->hint,
        ])->render();

        $this->attributes['for'] = $this->for;

        return <<<HTML
            <label {$this->getStringifiedAttributes()}>{$this->slot}{$optionalText}{$hint}</label>
        HTML;
    }
}
