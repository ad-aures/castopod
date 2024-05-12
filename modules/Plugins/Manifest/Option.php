<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

/**
 * @property string $label
 * @property string $value
 * @property ?string $hint
 */
class Option extends ManifestObject
{
    protected const VALIDATION_RULES = [
        'label' => 'required|string',
        'value' => 'required|alpha_dash',
        'hint'  => 'permit_empty|string',
    ];

    protected string $label;

    protected string $value;

    protected ?string $hint = null;
}
