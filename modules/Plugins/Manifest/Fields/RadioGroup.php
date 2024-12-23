<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest\Fields;

use Modules\Plugins\Manifest\Field;
use Modules\Plugins\Manifest\WithOptionsTrait;
use Override;

/**
 * @property string $defaultValue
 */
class RadioGroup extends Field
{
    use WithOptionsTrait;

    public static array $validation_rules = [
        'defaultValue' => 'permit_empty|string',
    ];

    protected string $defaultValue = '';

    public function __construct(string $pluginKey)
    {
        $this->injectRules();

        parent::__construct($pluginKey);
    }

    #[Override]
    public function loadData(array $data): void
    {
        $data = $this->transformData($data);

        parent::loadData($data);
    }

    public function render(string $name, mixed $value, string $class = ''): string
    {
        $isRequired = $this->optional ? 'false' : 'true';
        $options = esc(json_encode($this->getOptionsArray()));
        return <<<HTML
        <x-Forms.RadioGroup
            class="{$class}"
            name="{$name}"
            label="{$this->label}"
            hint="{$this->hint}"
            helper="{$this->helper}"
            options="{$options}"
            isRequired="{$isRequired}"
            value="{$value}"
            defaultValue="{$this->defaultValue}"
        />
        HTML;
    }
}
