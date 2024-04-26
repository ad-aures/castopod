<?php

declare(strict_types=1);

namespace ViewComponents;

use CodeIgniter\View\ViewDecoratorInterface;

/**
 * Enables rendering of View Components into the views.
 *
 * Borrowed and adapted from https://github.com/lonnieezell/Bonfire2/
 */
class Decorator implements ViewDecoratorInterface
{
    private static ?ComponentRenderer $components = null;

    public static function decorate(string $html): string
    {
        $components = self::factory();

        return $components->render($html);
    }

    /**
     * Factory method to create a new instance of ComponentRenderer
     */
    private static function factory(): ComponentRenderer
    {
        if (! self::$components instanceof ComponentRenderer) {
            self::$components = new ComponentRenderer();
        }

        return self::$components;
    }
}
