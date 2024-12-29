<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use Override;

class Input extends FormComponent
{
    protected array $props = ['type'];

    protected string $type = 'text';

    #[Override]
    public function render(): string
    {
        $this->mergeClass('w-full border-contrast rounded-lg focus:border-contrast border-3 focus-within:ring-accent transition');

        if ($this->type === 'file') {
            $this->mergeClass('file:px-3 file:py-2 file:h-[40px] file:font-semibold file:text-accent-hover file:text-sm file:rounded-none file:border-none file:bg-base file:cursor-pointer');
        } else {
            $this->mergeClass('px-3 py-2');
        }

        if ($this->isReadonly) {
            $this->mergeClass('bg-base');
        } else {
            $this->mergeClass('bg-elevated');
        }

        $this->attributes['type'] = $this->type;

        return form_input($this->attributes, $this->getValue());
    }
}
