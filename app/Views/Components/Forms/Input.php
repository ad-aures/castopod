<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class Input extends FormComponent
{
    protected string $type = 'text';

    public function render(): string
    {
        $baseClass = 'w-full bg-white border-black rounded-lg focus:border-black border-3 focus:ring-castopod focus-within:ring-castopod ' . $this->class;

        $this->attributes['class'] = $baseClass;

        if ($this->type === 'file') {
            $this->attributes['class'] .= ' file:px-3 file:py-2 file:h-[40px] file:font-semibold file:text-gray-800 file:text-sm file:rounded-none file:border-none file:bg-gray-200 file:hover:bg-gray-300 file:cursor-pointer';
        } else {
            $this->attributes['class'] .= ' px-3 py-2';
        }

        if ($this->required) {
            $this->attributes['required'] = 'required';
        }

        return form_input($this->attributes, old($this->name, $this->value));
    }
}
