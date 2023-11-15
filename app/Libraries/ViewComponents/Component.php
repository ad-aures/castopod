<?php

declare(strict_types=1);

namespace ViewComponents;

class Component implements ComponentInterface
{
    protected string $slot = '';

    protected string $class = '';

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
        helper('viewcomponents');

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
                $this->{$name} = $value;
            }
        }
    }

    public function render(): string
    {
        return static::class . ': RENDER METHOD NOT IMPLEMENTED';
    }
}
