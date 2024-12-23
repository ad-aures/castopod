<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

/**
 * @property Field[] $fields
 */
trait WithFieldsTrait
{
    /**
     * @var Field[]
     */
    protected array $options = [];

    public function injectRules(): void
    {
        $this::$validation_rules = [...$this::$validation_rules, ...[
            'fields' => 'is_list',
        ]];
        $this->casts = [...$this->casts, ...[
            'fields' => [Field::class],
        ]];
    }

    /**
     * @param array<mixed> $data
     * @return array<mixed>
     */
    public function transformData(array $data): array
    {
        if (array_key_exists('fields', $data)) {
            $newFields = [];
            foreach ($data['fields'] as $key => $field) {
                $field['key'] = $key;
                $newFields[] = $field;
            }

            $data['fields'] = $newFields;
        }

        return $data;
    }
}
