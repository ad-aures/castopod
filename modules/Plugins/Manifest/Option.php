<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

/**
 * @property string $label
 * @property string $value
 * @property string $hint
 */
class Option extends ManifestObject
{
    protected const VALIDATION_RULES = [
        'label'       => 'required|string',
        'value'       => 'required|alpha_numeric_punct',
        'description' => 'permit_empty|string',
    ];

    protected string $label;

    protected string $value;

    protected string $description = '';

    public function getTranslated(string $i18nKey, string $property): string
    {
        $key = sprintf('%s.%s.%s', $i18nKey, $this->value, $property);

        /** @var string $i18nField */
        $i18nField = lang($key);

        if ($this->{$property} === '' || $i18nField === $key) {
            return esc($this->{$property});
        }

        return esc($i18nField);
    }
}
