<?php

declare(strict_types=1);

namespace ViewComponents;

interface ComponentInterface
{
    public function render(): string;
}
