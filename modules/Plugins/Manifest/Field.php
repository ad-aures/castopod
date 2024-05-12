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
    public function getOptionsArray(): array
    {
        $optionsArray = [];
        foreach ($this->options as $option) {
            $optionsArray[] = [
                'label' => $option->label,
                'value' => $option->value,
                'hint'  => (string) $option->hint,
            ];
        }

        return $optionsArray;
    }
}
