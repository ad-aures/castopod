<?php

declare(strict_types=1);

namespace ViewComponents;

class Component implements ComponentInterface
{
    protected string $slot = '';

    /**
     * @var array<string, string>
     */
    protected array $attributes = [
        'class' => '',
    ];

    /**
     * @param array<string, string> $attributes
     */
    public function __construct(array $attributes)
    {
        if ($attributes !== []) {
            $this->hydrate($attributes);
        }
        // overwrite default attributes if set

        $this->attributes = array_merge($this->attributes, $attributes);
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
                $this->{$name} = $value;
            }
        }
    }

    public function render(): string
    {
        return static::class . ': RENDER METHOD NOT IMPLEMENTED';
    }
}
