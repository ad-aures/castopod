<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class Input extends FormComponent
{
    protected string $type = 'text';

    public function render(): string
    {
        $class = 'px-3 py-2 rounded-lg border-3 focus:ring-2 focus:ring-pine-500 focus:ring-offset-2 focus:ring-offset-pine-100 ' . $this->class;

        if (session()->has('errors')) {
            $error = session('errors')[$this->name];
            if ($error) {
                $class .= ' border-red';
            }
        } else {
            $class .= ' border-black focus:border-black';
        }

        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'class' => $class,
            'type' => $this->type,
        ];

        if ($this->required) {
            $data['required'] = 'required';
        }

        return form_input($data, old($this->name, $this->value));
    }
}
