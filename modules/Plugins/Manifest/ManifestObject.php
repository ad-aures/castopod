<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

use CodeIgniter\Validation\Validation;
use Exception;

abstract class ManifestObject
{
    protected const VALIDATION_RULES = [];

    /**
     * @var array<string,string|array{string}>
     */
    protected const CASTS = [];

    /**
     * @var array<string,string>
     */
    public static array $errors = [];

    /**
     * @param mixed[] $data
     */
    public function __construct(
        private readonly array $data
    ) {
        $this->load();
    }

    public function __get(string $name): mixed
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        throw new Exception('Undefined object property ' . static::class . '::' . $name);
    }

    public function load(): void
    {
        /** @var Validation $validation */
        $validation = service('validation');

        $validation->setRules($this::VALIDATION_RULES);

        if (! $validation->run($this->data)) {
            static::$errors = [...static::$errors, ...$validation->getErrors()];
        }

        foreach ($validation->getValidated() as $key => $value) {
            if (array_key_exists($key, $this::CASTS)) {
                $cast = $this::CASTS[$key];

                if (is_array($cast)) {
                    if (is_array($value)) {
                        foreach ($value as $valueKey => $valueElement) {
                            $value[$valueKey] = new $cast[0]($valueElement);
                        }
                    }
                } else {
                    $value = new $cast($value);
                }
            }

            $this->{$key} = $value;
        }
    }

    /**
     * @return array<string,string>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
