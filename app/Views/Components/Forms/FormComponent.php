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
        'isRequired',
        'isReadonly',
    ];

    protected array $casts = [
        'isRequired' => 'boolean',
        'isReadonly' => 'boolean',
    ];

    protected string $id;

    protected string $name;

    protected string $value = '';

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

    public function setValue(string $value): void
    {
        $this->value = htmlspecialchars_decode($value, ENT_QUOTES);
    }
}
