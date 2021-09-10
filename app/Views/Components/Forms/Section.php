<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class Section extends FormComponent
{
    protected string $title = '';

    protected ?string $subtitle = null;

    public function render(): string
    {
        $subtitle = $this->subtitle === null ? '' : '<p class="text-sm text-gray-600 clear-left">' . $this->subtitle . '</p>';

        return <<<HTML
            <fieldset class="w-full max-w-xl p-8 bg-white border-2 border-black rounded-xl {$this->class}">
                <Heading tagName="legend" class="float-left">{$this->title}</Heading>
                {$subtitle}
                <div class="flex flex-col gap-4 py-4 clear-left">{$this->slot}</div>
            </fieldset>
        HTML;
    }
}
