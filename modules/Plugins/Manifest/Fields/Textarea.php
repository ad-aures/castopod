<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest\Fields;

use Modules\Plugins\Manifest\Field;

/**
 * @property string $defaultValue
 */
class Textarea extends Field
{
    public static array $validation_rules = [
        'defaultValue' => 'permit_empty|string',
    ];

    protected string $defaultValue = '';

    public function render(string $name, mixed $value, string $class = ''): string
    {
        $isRequired = $this->optional ? 'false' : 'true';
        return <<<HTML
        <x-Forms.Field
            as="Textarea"
            class="{$class}"
            name="{$name}"
            label="{$this->label}"
            hint="{$this->hint}"
            helper="{$this->helper}"
            isRequired="{$isRequired}"
            value="{$value}"
            defaultValue="{$this->defaultValue}"
        />
        HTML;
    }
}
