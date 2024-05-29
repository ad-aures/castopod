<?php

declare(strict_types=1);

namespace App\Views\Components;

use Override;
use ViewComponents\Component;

class Heading extends Component
{
    protected array $props = ['tagName', 'size'];

    protected string $tagName = 'div';

    /**
     * @var 'small'|'base'|'large'
     */
    protected string $size = 'base';

    #[Override]
    public function render(): string
    {
        $sizeClass = match ($this->size) {
            'small' => 'tracking-wide text-base',
            'large' => 'text-3xl',
            default => 'text-xl',
        };

        $this->mergeClass('relative z-10 font-bold text-heading-foreground font-display before:w-full before:absolute before:h-1/2 before:left-0 before:bottom-0 before:rounded-full before:bg-heading-background before:z-[-10]');
        $this->mergeClass($sizeClass);

        return <<<HTML
            <{$this->tagName} {$this->getStringifiedAttributes()}>{$this->slot}</{$this->tagName}>
        HTML;
    }
}
