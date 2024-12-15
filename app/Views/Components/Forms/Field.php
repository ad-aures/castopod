<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use Override;
use ViewComponents\Component;

class Field extends Component
{
    protected array $props = [
        'name',
        'label',
        'isRequired',
        'isReadonly',
        'as',
        'hint',
        'helper',
    ];

    protected array $casts = [
        'isRequired' => 'boolean',
        'isReadonly' => 'boolean',
    ];

    protected string $name;

    protected string $label;

    protected bool $isRequired = false;

    protected bool $isReadonly = false;

    protected string $as = 'Input';

    protected string $hint = '';

    protected string $helper = '';

    #[Override]
    public function render(): string
    {
        $helperText = '';
        if ($this->helper !== '') {
            $helperId = $this->name . 'Help';
            $helperText = (new Helper([
                'id'   => $helperId,
                'slot' => $this->helper,
            ]))->render();
            $this->attributes['aria-describedby'] = $helperId;
        }

        $labelAttributes = [
            'for'        => $this->name,
            'isOptional' => $this->isRequired ? 'false' : 'true',
            'class'      => '-mb-1',
            'slot'       => $this->label,
        ];
        if ($this->hint !== '') {
            $labelAttributes['hint'] = $this->hint;
        }
        $label = new Label($labelAttributes);

        $this->mergeClass('flex flex-col');
        $fieldClass = $this->attributes['class'];

        unset($this->attributes['class']);

        $this->attributes['name'] = $this->name;
        $this->attributes['isRequired'] = var_export($this->isRequired, true);
        $this->attributes['isReadonly'] = var_export($this->isReadonly, true);
        $element = __NAMESPACE__ . '\\' . $this->as;
        $fieldElement = new $element($this->attributes);

        return <<<HTML
            <div class="{$fieldClass}">
                {$label->render()}
                {$helperText}
                <div class="relative w-full mt-1">
                    {$fieldElement->render()}
                </div>
            </div>
        HTML;
    }
}
