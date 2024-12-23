<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest\Fields;

use Modules\Plugins\Manifest\Field;

/**
 * @property bool $defaultValue
 */
class Toggler extends Field
{
    public static array $validation_rules = [
        'defaultValue' => 'permit_empty|is_boolean',
    ];

    protected bool $defaultValue = false;

    public function render(string $name, mixed $value, string $class = ''): string
    {
        $value = $value ? 'yes' : '';
        return <<<HTML
        <x-Forms.Toggler
            class="{$class}"
            name="{$name}"
            hint="{$this->hint}"
            helper="{$this->helper}"
            value="{$value}"
            defaultValue="{$this->defaultValue}"
            >{$this->label}</x-Forms.Toggler>
        HTML;
    }
}
