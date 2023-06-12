<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Colors extends BaseConfig
{
    /**
     * @var array<string, array<string, mixed>>
     */
    public array $themes = [
        /* Castopod's brand color */
        'pine' => [
            'accent-base'     => [174, 100, 29],
            'accent-hover'    => [172, 100, 17],
            'accent-muted'    => [131, 100, 12],
            'accent-contrast' => [0, 0, 100],

            'heading-foreground' => [172, 100, 17],
            'heading-background' => [111, 64, 94],

            'background-elevated'   => [0, 0, 100],
            'background-base'       => [173, 44, 96],
            'background-navigation' => [172, 100, 17],
            'background-header'     => [172, 100, 17],
            'background-highlight'  => [111, 64, 94],
            'background-backdrop'   => [0, 0, 50],

            'border-subtle'     => [111, 42, 86],
            'border-contrast'   => [0, 0, 0],
            'border-navigation' => [131, 100, 12],

            'text-base'  => [158, 8, 3],
            'text-muted' => [172, 8, 38],
        ],
        /* Red / Rose color */
        'crimson' => [
            'accent-base'     => [350, 87, 61],
            'accent-hover'    => [348, 75, 40],
            'accent-muted'    => [348, 73, 32],
            'accent-contrast' => [0, 0, 100],

            'heading-foreground' => [348, 73, 32],
            'heading-background' => [344, 79, 96],

            'background-elevated'  => [0, 0, 100],
            'background-base'      => [350, 44, 96],
            'background-header'    => [348, 75, 40],
            'background-highlight' => [344, 79, 96],
            'background-backdrop'  => [0, 0, 50],

            'border-subtle'   => [348, 42, 86],
            'border-contrast' => [0, 0, 0],

            'text-base'  => [340, 8, 3],
            'text-muted' => [345, 8, 38],
        ],
        /* Blue color */
        'lake' => [
            'accent-base'     => [194, 100, 44],
            'accent-hover'    => [194, 100, 22],
            'accent-muted'    => [195, 100, 11],
            'accent-contrast' => [0, 0, 100],

            'heading-foreground' => [194, 100, 22],
            'heading-background' => [195, 100, 92],

            'background-elevated'  => [0, 0, 100],
            'background-base'      => [196, 44, 96],
            'background-header'    => [194, 100, 22],
            'background-highlight' => [195, 100, 92],
            'background-backdrop'  => [0, 0, 50],

            'border-subtle'   => [195, 42, 86],
            'border-contrast' => [0, 0, 0],

            'text-base'  => [194, 8, 3],
            'text-muted' => [195, 8, 38],
        ],
        /* Orange color */
        'amber' => [
            'accent-base'     => [17, 100, 57],
            'accent-hover'    => [17, 100, 35],
            'accent-muted'    => [17, 100, 24],
            'accent-contrast' => [0, 0, 100],

            'heading-foreground' => [17, 100, 35],
            'heading-background' => [17, 100, 89],

            'background-elevated'  => [0, 0, 100],
            'background-base'      => [15, 44, 96],
            'background-header'    => [17, 100, 35],
            'background-highlight' => [17, 100, 89],
            'background-backdrop'  => [0, 0, 50],

            'border-subtle'   => [17, 42, 86],
            'border-contrast' => [0, 0, 0],

            'text-base'  => [15, 8, 3],
            'text-muted' => [17, 8, 38],
        ],
        /* Violet color */
        'jacaranda' => [
            'accent-base'     => [254, 72, 52],
            'accent-hover'    => [254, 73, 30],
            'accent-muted'    => [254, 71, 19],
            'accent-contrast' => [0, 0, 100],

            'heading-foreground' => [254, 73, 30],
            'heading-background' => [254, 73, 84],

            'background-elevated'  => [0, 0, 100],
            'background-base'      => [253, 44, 96],
            'background-header'    => [254, 73, 30],
            'background-highlight' => [254, 88, 91],
            'background-backdrop'  => [0, 0, 50],

            'border-subtle'   => [254, 42, 86],
            'border-contrast' => [0, 0, 0],

            'text-base'  => [253, 8, 3],
            'text-muted' => [254, 8, 38],
        ],
        /* Black color */
        'onyx' => [
            'accent-base'     => [240, 17, 2],
            'accent-hover'    => [240, 17, 17],
            'accent-muted'    => [240, 17, 17],
            'accent-contrast' => [0, 0, 100],

            'heading-foreground' => [240, 17, 17],
            'heading-background' => [240, 17, 94],

            'background-elevated'  => [0, 0, 100],
            'background-base'      => [240, 17, 96],
            'background-header'    => [240, 12, 17],
            'background-highlight' => [240, 17, 94],
            'background-backdrop'  => [0, 0, 50],

            'border-subtle'   => [240, 17, 86],
            'border-contrast' => [0, 0, 0],

            'text-base'  => [240, 8, 3],
            'text-muted' => [240, 8, 38],
        ],
    ];
}
