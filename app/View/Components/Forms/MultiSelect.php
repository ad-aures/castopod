<?php

declare(strict_types=1);

namespace App\View\Components\Forms;

use ViewComponents\Component;

class MultiSelect extends Component
{
    /**
     * @var array<string, string>
     */
    protected array $options = [];

    /**
     * @var string[]
     */
    protected array $selected = [];

    public function render(): string
    {
        $defaultAttributes = [
            'data-class' => $this->attributes['class'],
            'multiple' => 'multiple',
        ];
        $extra = array_merge($defaultAttributes, $this->attributes);

        return form_dropdown($this->attributes['name'], $this->options, $this->selected, $extra);
    }
}
