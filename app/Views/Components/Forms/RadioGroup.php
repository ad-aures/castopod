<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use App\Views\Components\Hint;
use Override;

class RadioGroup extends FormComponent
{
    protected array $props = ['label', 'options', 'hint', 'helper'];

    protected array $casts = [
        'options' => 'array',
    ];

    protected string $label;

    /**
     * @var array{value:string,label:string,hint?:string}
     */
    protected array $options = [];

    protected string $hint = '';

    protected string $helper = '';

    #[Override]
    public function render(): string
    {
        $this->mergeClass('flex flex-col');
        $options = '';
        foreach ($this->options as $option) {
            $radioButtonData = [
                'value'       => $option['value'],
                'name'        => $this->name,
                'slot'        => $option['label'],
                'description' => $option['description'] ?? '',
                'isSelected'  => var_export($this->getValue() === '' ? $option['value'] === $this->options[0]['value'] : $option['value'] === $this->getValue(), true),
                'isRequired'  => var_export($this->isRequired, true),
            ];

            $options .= new RadioButton($radioButtonData)->render();
        }

        $helperText = '';
        if ($this->helper !== '') {
            $helperId = $this->name . 'Help';
            $helperText = new Helper([
                'id'   => $helperId,
                'slot' => $this->helper,
            ])->render();
            $this->attributes['aria-describedby'] = $helperId;
        }

        $hint = $this->hint === '' ? '' : new Hint([
            'class' => 'ml-1',
            'slot'  => $this->hint,
        ])->render();

        return <<<HTML
        <fieldset {$this->getStringifiedAttributes()}>
            <legend class="-mb-1 text-sm font-semibold">{$this->label}{$hint}</legend>
            {$helperText}
            <div class="grid grid-cols-radioGroup gap-2 mt-1">{$options}</div>
        </fieldset>
        HTML;
    }
}
