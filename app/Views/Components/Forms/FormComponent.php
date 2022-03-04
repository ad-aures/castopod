<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use ViewComponents\Component;

class FormComponent extends Component
{
    protected ?string $id = null;

    protected string $name = '';

    protected string $value = '';

    protected bool $required = false;

    protected bool $readonly = false;

    /**
     * @param array<string, string> $attributes
     */
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        if ($this->id === null) {
            $this->id = $this->name;
            $this->attributes['id'] = $this->id;
        }
    }

    public function setRequired(string $value): void
    {
        $this->required = $value === 'true';
    }

    public function setReadonly(string $value): void
    {
        $this->readonly = $value === 'true';
        if ($this->readonly) {
            $this->attributes['readonly'] = 'readonly';
        } else {
            unset($this->attributes['readonly']);
        }
    }
}
