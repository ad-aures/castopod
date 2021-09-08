<?php

declare(strict_types=1);

namespace App\Views\Components;

use Exception;
use ViewComponents\Component;

class Heading extends Component
{
    protected string $level = '';

    /**
     * @var "small"|"base"|"large"
     */
    protected string $size = 'base';

    public function render(): string
    {
        if ($this->level === '') {
            throw new Exception('level property must be set for Heading component.');
        }

        $sizeClasses = [
            'small' => 'tracking-wide text-base',
            'base' => 'text-xl',
            'large' => 'text-3xl',
        ];

        $class = 'relative z-10 font-bold text-pine-800 font-display before:w-full before:absolute before:h-1/2 before:left-0 before:bottom-0 before:rounded-full before:bg-pine-100 before:-z-10 ' . $sizeClasses[$this->size];
        $level = $this->level;

        return <<<HTML
            <h{$level} class="{$class}">{$this->slot}</h{$level}>
        HTML;
    }
}
