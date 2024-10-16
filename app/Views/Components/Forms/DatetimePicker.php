<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use Override;

class DatetimePicker extends FormComponent
{
    protected array $attributes = [
        'data-picker' => 'datetime',
    ];

    #[Override]
    public function render(): string
    {
        $dateInput = form_input([
            'name'       => $this->name,
            'class'      => 'rounded-l-lg border-0 border-rounded-r-none flex-1 focus:ring-0',
            'data-input' => '',
        ], old($this->name, (string) $this->value));

        $clearLabel = lang(
            'Episode.publish_form.scheduled_publication_date_clear',
        );
        $closeIcon = icon('close-fill');

        $this->mergeClass('flex border-3 rounded-lg border-contrast focus-within:ring-accent');

        return <<<HTML
            <div {$this->getStringifiedAttributes()}>
                {$dateInput}
                <button class="p-3 bg-elevated hover:bg-base rounded-r-md focus:ring-inset" type="button" aria-label="{$clearLabel}" title="{$clearLabel}" data-clear="">
                    {$closeIcon}
                </button>
            </div>
        HTML;
    }
}
