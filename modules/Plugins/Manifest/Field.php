<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

use Override;

/**
 * @property 'checkbox'|'datetime'|'email'|'group'|'html'|'markdown'|'number'|'radio-group'|'rss'|'select-multiple'|'select'|'text'|'textarea'|'toggler'|'url' $type
 * @property string $key
 * @property string $label
 * @property string $hint
 * @property string $helper
 * @property bool $optional
 * @property Option[] $options
 * @property bool $multiple
 * @property Field[] $fields
 */
class Field extends ManifestObject
{
    protected const VALIDATION_RULES = [
        'type'     => 'permit_empty|in_list[checkbox,datetime,email,group,html,markdown,number,radio-group,rss,select-multiple,select,text,textarea,toggler,url]',
        'key'      => 'required|alpha_dash',
        'label'    => 'required|string',
        'hint'     => 'permit_empty|string',
        'helper'   => 'permit_empty|string',
        'optional' => 'permit_empty|is_boolean',
        'options'  => 'permit_empty|is_list',
        'multiple' => 'permit_empty|is_boolean',
        'fields'   => 'permit_empty|is_list',
    ];

    protected const CASTS = [
        'options' => [Option::class],
        'fields'  => [self::class],
    ];

    protected string $type = 'text';

    protected string $key;

    protected string $label;

    protected string $hint = '';

    protected string $helper = '';

    protected bool $optional = false;

    protected bool $multiple = false;

    /**
     * @var Option[]
     */
    protected array $options = [];

    #[Override]
    public function loadData(array $data): void
    {
        if (array_key_exists('options', $data)) {
            $newOptions = [];
            foreach ($data['options'] as $key => $option) {
                $option['value'] = $key;
                $newOptions[] = $option;
            }

            $data['options'] = $newOptions;
        }

        if (array_key_exists('fields', $data)) {
            $newFields = [];
            foreach ($data['fields'] as $key => $field) {
                $field['key'] = $key;
                $newFields[] = $field;
            }

            $data['fields'] = $newFields;
        }

        parent::loadData($data);
    }

    /**
     * @return array{label:string,value:string,description:string}[]
     */
    public function getOptionsArray(string $pluginKey): array
    {
        $i18nKey = sprintf('%s.settings.%s.%s.options', $pluginKey, $this->type, $this->key);

        $optionsArray = [];
        foreach ($this->options as $option) {
            $optionsArray[] = [
                'value'       => $option->value,
                'label'       => $option->getTranslated($i18nKey, 'label'),
                'description' => $option->getTranslated($i18nKey, 'description'),
            ];
        }

        return $optionsArray;
    }

    public function getTranslated(string $pluginKey, string $property): string
    {
        $key = sprintf('Plugin.%s.settings.%s.%s.%s', $pluginKey, $this->type, $this->key, $property);

        /** @var string $i18nField */
        $i18nField = lang($key);

        if ($this->{$property} === '' || $i18nField === $key) {
            return esc($this->{$property});
        }

        return esc($i18nField);
    }
}
