<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

use Override;

/**
 * @property Field[] $general
 * @property Field[] $podcast
 * @property Field[] $episode
 */
class Settings extends ManifestObject
{
    public static array $validation_rules = [
        'general' => 'permit_empty|is_list',
        'podcast' => 'permit_empty|is_list',
        'episode' => 'permit_empty|is_list',
    ];

    /**
     * @var array<string,array{string}|string>
     */
    protected array $casts = [
        'general' => [Field::class],
        'podcast' => [Field::class],
        'episode' => [Field::class],
    ];

    /**
     * @var Field[]
     */
    protected array $general = [];

    /**
     * @var Field[]
     */
    protected array $podcast = [];

    /**
     * @var Field[]
     */
    protected array $episode = [];

    #[Override]
    public function loadData(array $data): void
    {
        $newData = [];
        foreach ($data as $key => $fields) {
            $newFields = [];
            foreach ($fields as $fieldKey => $field) {
                $field['key'] = $fieldKey;
                $newFields[] = $field;
            }

            $newData[$key] = $newFields;
        }

        parent::loadData($newData);
    }
}
