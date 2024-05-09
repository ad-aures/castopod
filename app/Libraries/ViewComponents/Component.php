<?php

declare(strict_types=1);

namespace ViewComponents;

abstract class Component implements ComponentInterface
{
    /**
     * @var list<string>
     */
    protected array $props = [];

    /**
     * @var array<string, string|'boolean'|'array'|'number'>
     */
    protected array $casts = [];

    protected ?string $slot = null;

    /**
     * @var array<string, string>
     */
    protected array $attributes = [];

    /**
     * @param array<string, string> $attributes
     */
    public function __construct(array $attributes)
    {
        // overwrite default attributes if set
        $this->attributes = [...$this->attributes, ...$attributes];

        if ($attributes !== []) {
            $this->hydrate($attributes);
        }
    }

    /**
     * @param array<string, string> $attributes
     */
    public function hydrate(array $attributes): void
    {
        foreach ($attributes as $name => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
            if (is_callable([$this, $method])) {
                $this->{$method}($value);
            } else {
                if (array_key_exists($name, $this->casts)) {
                    $value = match ($this->casts[$name]) {
                        'boolean' => $value === 'true',
                        'number'  => (int) $value,
                        'array'   => json_decode(htmlspecialchars_decode($value), true),
                        default   => $value
                    };
                }

                $this->{$name} = $value;
            }

            // remove from attributes
            if (in_array($name, $this->props, true)) {
                unset($this->attributes[$name]);
            }
        }

        unset($this->attributes['slot']);
    }

    public function mergeClass(string $class): void
    {
        if (! array_key_exists('class', $this->attributes)) {
            $this->attributes['class'] = $class;
        } else {
            $this->attributes['class'] .= ' ' . $class;
        }
    }

    public function getStringifiedAttributes(): string
    {
        return stringify_attributes($this->attributes);
    }

    public function render(): string
    {
        return static::class . ': RENDER METHOD NOT IMPLEMENTED';
    }
}
