<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use ViewComponents\Component;

abstract class FormComponent extends Component
{
    protected array $props = [
        'id',
        'name',
        'value',
        'defaultValue',
        'isRequired',
        'isReadonly',
    ];

    protected array $casts = [
        'isRequired' => 'boolean',
        'isReadonly' => 'boolean',
    ];

    protected string $id;

    protected string $name;

    /**
     * @var string|string[]|null
     */
    protected string|array|null $value = null;

    /**
     * @var string|string[]
     */
    protected string|array $defaultValue = '';

    protected bool $isRequired = false;

    protected bool $isReadonly = false;

    /**
     * @param array<string, string> $attributes
     */
    public function __construct(array $attributes)
    {
        $parentVars = get_class_vars(self::class);
        $this->casts = [...$parentVars['casts'], ...$this->casts];
        $this->props = [...$parentVars['props'], $this->props];

        parent::__construct($attributes);

        if (! isset($this->id)) {
            $this->id = $this->name;
        }

        $this->attributes['id'] = $this->id;
        $this->attributes['name'] = $this->name;

        if ($this->isRequired) {
            $this->attributes['required'] = 'required';
        }

        if ($this->isReadonly) {
            $this->attributes['readonly'] = 'readonly';
        }
    }

    protected function getValue(): string|array
    {
        $valueCast = $this->casts['value'] ?? '';
        if ($valueCast === 'array') {
            return old($this->name, in_array($this->value, [[], null], true) ? $this->defaultValue : $this->value) ?? [];
        }

        return old(
            $this->name,
            in_array($this->value, ['', null], true) ? $this->defaultValue : $this->value
        ) ?? '';
    }
}
