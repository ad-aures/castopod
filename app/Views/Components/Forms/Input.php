<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class Input extends FormComponent
{
    protected string $type = 'text';

    public function render(): string
    {
        $baseClass = 'w-full border-contrast rounded-lg focus:border-contrast border-3 focus:ring-accent focus-within:ring-accent ' . $this->class;

        $this->attributes['class'] = $baseClass;

        if ($this->type === 'file') {
            $this->attributes['class'] .= ' file:px-3 file:py-2 file:h-[40px] file:font-semibold file:text-skin-muted file:text-sm file:rounded-none file:border-none file:bg-highlight file:cursor-pointer';
        } else {
            $this->attributes['class'] .= ' px-3 py-2';
        }

        if ($this->readonly) {
            $this->attributes['class'] .= ' bg-base';
        } else {
            $this->attributes['class'] .= ' bg-elevated';
        }

        return form_input($this->attributes, old($this->name, $this->value));
    }
}
