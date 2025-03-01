<?php

declare(strict_types=1);

use PHPIcons\Config\PHPIconsConfig;

return PHPIconsConfig::configure()
    ->withPaths([__DIR__ . '/app', __DIR__ . '/themes', __DIR__ . '/resources'])
    ->withLocalIconSets([
        'funding'    => __DIR__ . '/resources/icons/funding',
        'podcasting' => __DIR__ . '/resources/icons/podcasting',
        'social'     => __DIR__ . '/resources/icons/social',
    ])
    ->withDefaultIconPerSet([
        'funding'    => 'funding:default',
        'podcasting' => 'podcasting:default',
        'social'     => 'social:default',
    ])
    ->withDefaultPrefix('ri')
    ->withPlaceholder('�');
