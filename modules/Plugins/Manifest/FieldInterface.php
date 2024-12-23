<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

interface FieldInterface
{
    public function render(string $name, mixed $value, string $class = ''): string;
}
