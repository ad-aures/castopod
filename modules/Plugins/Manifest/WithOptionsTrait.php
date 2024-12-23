<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

/**
 * @property Option[] $options
 */
trait WithOptionsTrait
{
    /**
     * @var Option[]
     */
    protected array $options = [];

    public function injectRules(): void
    {
        if (isset($this::$validation_rules)) {
            $this::$validation_rules = [...$this::$validation_rules, ...[
                'options' => 'is_list',
            ]];
        }

        if (isset($this->casts)) {
            $this->casts = [...$this->casts, ...[
                'options' => [Option::class],
            ]];
        }
    }

    /**
     * @param array<mixed> $data
     * @return array<mixed>
     */
    public function transformData(array $data): array
    {
        if (array_key_exists('options', $data)) {
            $newOptions = [];
            foreach ($data['options'] as $key => $option) {
                $option['value'] = $key;
                $newOptions[] = $option;
            }

            $data['options'] = $newOptions;
        }

        return $data;
    }

    /**
     * @return array{label:string,value:string,description:string}[]
     */
    public function getOptionsArray(): array
    {
        $i18nKey = sprintf('%s.settings.%s.%s.options', $this->pluginKey, $this->type, $this->key);

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
}
