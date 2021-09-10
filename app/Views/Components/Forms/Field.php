<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

class Field extends FormComponent
{
    protected string $as = 'Input';

    protected string $label = '';

    protected ?string $helperText = null;

    protected ?string $hintText = null;

    public function render(): string
    {
        $helperText = $this->helperText === null ? '' : '<Forms.Helper>' . $this->helperText . '</Forms.Helper>';

        $labelAttributes = [
            'for' => $this->id,
            'isOptional' => $this->required ? 'false' : 'true',
        ];
        if ($this->hintText) {
            $labelAttributes['hint'] = $this->hintText;
        }
        $labelAttributes = stringify_attributes($labelAttributes);

        // remove field specific attributes to inject the rest to Form Component
        $fieldComponentAttributes = $this->attributes;
        unset($fieldComponentAttributes['as']);
        unset($fieldComponentAttributes['label']);
        unset($fieldComponentAttributes['class']);
        unset($fieldComponentAttributes['helperText']);
        unset($fieldComponentAttributes['hintText']);

        $fieldComponentAttributes = flatten_attributes($fieldComponentAttributes);

        return <<<HTML
            <div class="flex flex-col {$this->class}">
                <Forms.Label {$labelAttributes}>{$this->label}</Forms.Label>
                <Forms.{$this->as} {$fieldComponentAttributes} class="mb-1"/>
                {$helperText}
            </div>
        HTML;
    }
}
