<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

use CodeIgniter\Validation\Validation;
use Exception;

abstract class ManifestObject
{
    /**
     * @var array<string,string>
     */
    public static array $validation_rules = [];

    /**
     * @var array<string,string|array{string}>
     */
    protected array $casts = [];

    /**
     * @var array<string,array<string,string>>
     */
    protected static array $errors = [];

    public function __construct(
        protected readonly string $pluginKey,
    ) {
        self::$errors[$pluginKey] = [];

        $class = static::class;
        $validation_rules = [];
        $casts = [];
        while ($class = get_parent_class($class)) {
            $validation_rules = [...$validation_rules, ...get_class_vars($class)['validation_rules']];
            $casts = [...$casts, ...get_class_vars($class)['casts']];
        }

        $this::$validation_rules = [...$validation_rules, ...$this::$validation_rules];
        $this->casts = [...$casts, ...$this->casts];
    }

    public function __get(string $name): mixed
    {
        if (property_exists($this, $name)) {
            // if a get method exists for this property, return that
            $method = 'get' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $name)));
            if (method_exists($this, $method)) {
                return $this->{$method}();
            }

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

        $validation->setRules($this::$validation_rules);

        if (! $validation->run($data)) {
            foreach ($validation->getErrors() as $key => $message) {
                $this->addError($key, $message);
            }

            $validation->reset();
        }

        foreach ($validation->getValidated() as $key => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            if (is_callable([$this, $method])) {
                $this->{$method}($value);
                continue;
            }

            if (array_key_exists($key, $this->casts)) {
                $cast = $this->casts[$key];
                if (is_array($cast) && is_array($value)) {
                    foreach ($value as $valueKey => $valueElement) {
                        if (is_subclass_of($cast[0], self::class)) {
                            $manifestClass = $cast[0] === Field::class ? $this->getFieldClass(
                                $valueElement
                            ) : $cast[0];
                            $value[$valueKey] = new $manifestClass($this->pluginKey);
                            $value[$valueKey]->loadData($valueElement);
                        } else {
                            $value[$valueKey] = new $cast[0]($valueElement);
                        }
                    }
                } elseif (is_subclass_of($cast, self::class)) {
                    $manifestClass = $cast === Field::class ? $this->getFieldClass($value) : $cast;
                    $valueElement = $value;
                    $value = new $manifestClass($this->pluginKey);
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

    /**
     * @param array<mixed> $data
     */
    private function getFieldClass(array $data): string
    {
        $fieldType = $data['type'] ?? 'text';
        return rtrim(Field::class, "\Field") . '\\Fields\\' . str_replace(
            ' ',
            '',
            ucwords(str_replace('-', ' ', $fieldType))
        );
    }
}
