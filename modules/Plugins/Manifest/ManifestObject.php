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
     * @var array<string,array<string,string>>
     */
    protected static array $errors = [];

    public function __construct(
        protected readonly string $pluginKey,
    ) {
        self::$errors[$pluginKey] = [];
    }

    public function __get(string $name): mixed
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        throw new Exception('Undefined object property ' . static::class . '::' . $name);
    }

    public function __isset(string $property): bool
    {
        return property_exists($this, $property);
    }

    public function loadFromFile(string $manifestPath): void
    {
        $manifestContents = @file_get_contents($manifestPath);

        if (! $manifestContents) {
            $manifestContents = '{}';
            $this->addError('manifest', lang('Plugins.errors.manifestMissing', [
                'manifestPath' => $manifestPath,
            ]));
        }

        /** @var array<mixed>|null $manifestData */
        $manifestData = json_decode($manifestContents, true);

        if ($manifestData === null) {
            $manifestData = [];
            $this->addError('manifest', lang('Plugins.errors.manifestJsonInvalid', [
                'manifestPath' => $manifestPath,
            ]));
        }

        $this->loadData($manifestData);
    }

    /**
     * @param array<mixed> $data
     */
    public function loadData(array $data): void
    {
        /** @var Validation $validation */
        $validation = service('validation');

        $validation->setRules($this::VALIDATION_RULES);

        if (! $validation->run($data)) {
            foreach ($validation->getErrors() as $key => $message) {
                $this->addError($key, $message);
            }

            $validation->reset();
        }

        foreach ($validation->getValidated() as $key => $value) {
            if (array_key_exists($key, $this::CASTS)) {
                $cast = $this::CASTS[$key];

                if (is_array($cast)) {
                    if (is_array($value)) {
                        foreach ($value as $valueKey => $valueElement) {
                            if (is_subclass_of($cast[0], self::class)) {
                                $value[$valueKey] = new $cast[0]($this->pluginKey);
                                $value[$valueKey]->loadData($valueElement);
                            } else {
                                $value[$valueKey] = new $cast[0]($valueElement);
                            }
                        }
                    }
                } elseif (is_subclass_of($cast, self::class)) {
                    $valueElement = $value;
                    $value = new $cast($this->pluginKey);
                    $value->loadData($valueElement ?? []);
                } else {
                    $value = new $cast($value ?? []);
                }
            }

            $this->{$key} = $value;
        }
    }

    /**
     * @return array<string,string>
     */
    public static function getPluginErrors(string $pluginKey): array
    {
        return self::$errors[$pluginKey];
    }

    protected function addError(string $errorKey, string $errorMessage): void
    {
        self::$errors[$this->pluginKey][$errorKey] = $errorMessage;
    }
}
