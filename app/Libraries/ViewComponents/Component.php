<?php

declare(strict_types=1);

namespace ViewComponents;

class Component implements ComponentInterface
{
    /**
     * @var array<string, string>
     */
    protected array $attributes = [
        'class' => '',
    ];

    /**
     * @param array<string, mixed> $properties
     * @param array<string, string> $attributes
     */
    public function __construct(
        protected array $properties,
        array $attributes
    ) {
        // overwrite default properties if set
        foreach ($properties as $key => $value) {
            $this->{$key} = $value;
        }

        $this->attributes = array_merge($this->attributes, $attributes);
    }

    public function render(): string
    {
        return static::class . ': RENDER METHOD NOT IMPLEMENTED';
    }
}
