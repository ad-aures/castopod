<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class Field extends FormComponent
{
    protected string $as = 'Input';

    protected string $label = '';

    protected ?string $helper = null;

    protected ?string $hint = null;

    public function render(): string
    {
        $helperText = '';
        if ($this->helper !== null) {
            $helperId = $this->id . 'Help';
            $helperText = '<Forms.Helper id="' . $helperId . '">' . $this->helper . '</Forms.Helper>';
            $this->attributes['aria-describedby'] = $helperId;
        }

        $labelAttributes = [
            'for'        => $this->id,
            'isOptional' => $this->required ? 'false' : 'true',
        ];
        if ($this->hint) {
            $labelAttributes['hint'] = $this->hint;
        }
        $labelAttributes = stringify_attributes($labelAttributes);

        // remove field specific attributes to inject the rest to Form Component
        $fieldComponentAttributes = $this->attributes;
        unset($fieldComponentAttributes['as']);
        unset($fieldComponentAttributes['label']);
        unset($fieldComponentAttributes['class']);
        unset($fieldComponentAttributes['helper']);
        unset($fieldComponentAttributes['hint']);

        $fieldComponentAttributes['class'] = 'mb-1';

        $element = __NAMESPACE__ . '\\' . $this->as;
        $fieldElement = new $element($fieldComponentAttributes);

        return <<<HTML
            <div class="flex flex-col {$this->class}">
                <Forms.Label {$labelAttributes}>{$this->label}</Forms.Label>
                {$fieldElement->render()}
                {$helperText}
            </div>
        HTML;
    }
}
