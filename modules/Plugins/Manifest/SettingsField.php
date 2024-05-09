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
class SettingsField extends ManifestObject
{
    protected const VALIDATION_RULES = [
        'type'     => 'permit_empty|in_list[text,email,url,markdown,number,switch]',
        'key'      => 'required|alpha_dash',
        'label'    => 'required|string',
        'hint'     => 'permit_empty|string',
        'helper'   => 'permit_empty|string',
        'optional' => 'permit_empty|is_boolean',
    ];

    protected string $type = 'text';

    protected string $key;

    protected string $label;

    protected string $hint = '';

    protected string $helper = '';

    protected bool $optional = false;
}
