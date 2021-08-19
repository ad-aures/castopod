<?php

declare(strict_types=1);

namespace ViewComponents;

use ViewComponents\Config\ViewComponents;
use ViewComponents\Exceptions\ComponentNotFoundException;

class ComponentLoader
{
    protected ViewComponents $config;

    protected string $name;

    /**
     * @var array<string, mixed>
     */
    protected array $properties = [];

    /**
     * @var array<string, string>
     */
    protected array $attributes = [];

    public function __construct()
    {
        $this->config = config('ViewComponents');
    }

    public function __get(string $property): mixed
    {
        if (property_exists($this, $property)) {
            return $this->{$property};
        }
    }

    // @phpstan-ignore-next-line
    public function __set(string $property, mixed $value)
    {
        if (property_exists($this, $property)) {
            $this->{$property} = $value;
        }

        return $this;
    }

    /**
     * @throws ComponentNotFoundException
     */
    public function load(): string
    {
        // first, check if there exists a component class to load in class components path
        if (file_exists("{$this->config->classComponentsPath}/{$this->name}.php")) {
            return $this->loadComponentClass();
        }

        // check for the existence of a view file if no component class has been found
        // component view files are camel case
        $camelCaseName = strtolower(preg_replace('~(?<!^)(?<!\/)[A-Z]~', '_$0', $this->name) ?? '');

        if (file_exists("{$this->config->componentsViewPath}/{$camelCaseName}.php")) {
            return $this->loadComponentView($camelCaseName);
        }

        throw new ComponentNotFoundException("Could not find component \"{$this->name}\"");
    }

    private function loadComponentClass(): string
    {
        $classComponentsNamespace = $this->config->classComponentsNamespace;

        $namespacedName = str_replace('/', '\\', $this->name);
        $componentClassNamespace = "{$classComponentsNamespace}\\{$namespacedName}";

        $component = new $componentClassNamespace($this->properties, $this->attributes);
        return $component->render();
    }

    private function loadComponentView(string $name): string
    {
        $viewData = [...$this->properties, ...$this->attributes];

        return view("components/{$name}", $viewData);
    }
}
