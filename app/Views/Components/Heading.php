<?php

declare(strict_types=1);

namespace App\Views\Components;

use ViewComponents\Component;

class Heading extends Component
{
    protected string $tagName = 'div';

    /**
     * @var 'small'|'base'|'large'
     */
    protected string $size = 'base';

    public function render(): string
    {
        $sizeClasses = [
            'small' => 'tracking-wide text-base',
            'base' => 'text-xl',
            'large' => 'text-3xl',
        ];

        $class = $this->class . ' relative z-10 font-bold text-heading-foreground font-display before:w-full before:absolute before:h-1/2 before:left-0 before:bottom-0 before:rounded-full before:bg-heading-background before:z-[-10] ' . $sizeClasses[$this->size];

        return <<<HTML
            <{$this->tagName} class="{$class}">{$this->slot}</{$this->tagName}>
        HTML;
    }
}
