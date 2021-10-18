<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class Input extends FormComponent
{
    protected string $type = 'text';

    public function render(): string
    {
        $class = 'px-3 py-2 bg-white border-black rounded-lg focus:border-black border-3 focus:ring-castopod ' . $this->class;

        $this->attributes['class'] = $class;

        if ($this->required) {
            $this->attributes['required'] = 'required';
        }

        return form_input($this->attributes, old($this->name, $this->value));
    }
}
