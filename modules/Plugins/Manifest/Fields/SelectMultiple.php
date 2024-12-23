<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest\Fields;

use Modules\Plugins\Manifest\Field;
use Modules\Plugins\Manifest\WithOptionsTrait;
use Override;

/**
 * @property list<string> $defaultValue
 */
class SelectMultiple extends Field
{
    use WithOptionsTrait;

    public static array $validation_rules = [
        'defaultValue' => 'permit_empty|is_list',
    ];

    /**
     * @var list<string>
     */
    protected array $defaultValue = [];

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
        $value = esc(json_encode($value));
        $defaultValue = esc(json_encode($this->defaultValue));
        return <<<HTML
        <x-Forms.Field
            as="SelectMulti"
            class="{$class}"
            name="{$name}"
            label="{$this->label}"
            hint="{$this->hint}"
            helper="{$this->helper}"
            options="{$options}"
            isRequired="{$isRequired}"
            value="{$value}"
            defaultValue="{$defaultValue}"
        />
        HTML;
    }
}
