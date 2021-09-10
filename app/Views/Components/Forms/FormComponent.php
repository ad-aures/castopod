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

    public function __construct($attributes)
    {
        parent::__construct($attributes);

        if ($this->id === null) {
            $this->id = $this->name;
        }
    }

    public function setRequired(string $value): void
    {
        $this->required = $value === 'true';
    }
}
