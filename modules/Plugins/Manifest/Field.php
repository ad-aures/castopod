<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

use RuntimeException;

/**
 * @property 'checkbox'|'datetime'|'email'|'group'|'html'|'markdown'|'number'|'radio-group'|'rss'|'select-multiple'|'select'|'text'|'textarea'|'toggler'|'url' $type
 * @property string $key
 * @property string $label
 * @property string $hint
 * @property string $helper
 * @property string $defaultValue
 * @property bool $optional
 * @property bool $multiple
 * @property string[] $validationRules
 */
class Field extends ManifestObject implements FieldInterface
{
    public static array $validation_rules = [
        'type'            => 'permit_empty|in_list[checkbox,datetime,email,group,html,markdown,number,radio-group,rss,select-multiple,select,text,textarea,toggler,url]',
        'key'             => 'required|alpha_dash',
        'label'           => 'required|string',
        'hint'            => 'permit_empty|string',
        'helper'          => 'permit_empty|string',
        'validationRules' => 'permit_empty|is_string_or_list',
        'optional'        => 'permit_empty|is_boolean',
        'multiple'        => 'permit_empty|is_boolean',
    ];

    protected string $type = 'text';

    protected string $key;

    protected string $label;

    protected string $hint = '';

    protected string $helper = '';

    /**
     * @var string[]
     */
    protected array $validationRules = [];

    protected bool $optional = false;

    protected bool $multiple = false;

    public function getLabel(): string
    {
        return $this->getTranslated('label');
    }

    public function getHint(): string
    {
        return $this->getTranslated('hint');
    }

    public function getHelper(): string
    {
        return $this->getTranslated('helper');
    }

    /**
     * @param string|list<string> $values
     */
    public function setValidationRules(string|array $values): void
    {
        $validationRules = [];
        if (is_string($values)) {
            $validationRules = explode('|', $values);
        }

        $allowedRules = [
            'alpha',
            'alpha_dash',
            'alpha_numeric',
            'alpha_numeric_punct',
            'alpha_numeric_space',
            'alpha_space',
            'decimal',
            'differs',
            'exact_length',
            'greater_than',
            'greater_than_equal_to',
            'hex',
            'in_list',
            'integer',
            'is_natural',
            'is_natural_no_zero',
            'less_than',
            'less_than_equal_to',
            'max_length',
            'min_length',
            'not_in_list',
            'regex_match',
            'valid_base64',
            'valid_date',
        ];
        foreach ($validationRules as $rule) {
            foreach ($allowedRules as $allowedRule) {
                if (str_starts_with($rule, $allowedRule)) {
                    $this->validationRules[] = $rule;
                }
            }
        }
    }

    public function render(string $name, mixed $value, string $class = ''): string
    {
        throw new RuntimeException('Render function not defined in parent Field class');
    }

    private function getTranslated(string $property): string
    {
        $key = sprintf('Plugin.%s.settings.%s.%s.%s', $this->pluginKey, $this->type, $this->key, $property);

        /** @var string $i18nField */
        $i18nField = lang($key);

        if ($this->{$property} === '' || $i18nField === $key) {
            return esc($this->{$property});
        }

        return esc($i18nField);
    }
}
