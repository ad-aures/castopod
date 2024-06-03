<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

/**
 * @property 'text'|'email'|'url'|'markdown'|'number'|'switch' $type
 * @property string $key
 * @property string $label
 * @property string $hint
 * @property string $helper
 * @property bool $optional
 */
class Field extends ManifestObject
{
    protected const VALIDATION_RULES = [
        'type'     => 'permit_empty|in_list[checkbox,datetime,email,markdown,number,radio-group,select-multiple,select,text,textarea,toggler,url]',
        'key'      => 'required|alpha_dash',
        'label'    => 'required|string',
        'hint'     => 'permit_empty|string',
        'helper'   => 'permit_empty|string',
        'optional' => 'permit_empty|is_boolean',
        'options'  => 'permit_empty|is_list',
    ];

    protected const CASTS = [
        'options' => [Option::class],
    ];

    protected string $type = 'text';

    protected string $key;

    protected string $label;

    protected string $hint = '';

    protected string $helper = '';

    protected bool $optional = false;

    /**
     * @var Option[]
     */
    protected array $options = [];

    /**
     * @return array{label:string,value:string,hint:string}[]
     */
    public function getOptionsArray(string $i18nKey): array
    {
        $optionsArray = [];
        foreach ($this->options as $option) {
            $optionsArray[] = [
                'value' => $option->value,
                'label' => esc($this->getTranslated($i18nKey . '.' . $option->value . '.label', $option->label)),
                'hint'  => esc($this->getTranslated($i18nKey . '.' . $option->value . '.hint', (string) $option->hint)),
            ];
        }

        return $optionsArray;
    }

    public function getTranslated(string $i18nKey, string $default): string
    {
        $key = 'Plugin.' . $i18nKey;

        /** @var string $i18nField */
        $i18nField = lang($key);

        if ($default === '' || $i18nField === $key) {
            return $default;
        }

        return $i18nField;
    }
}
