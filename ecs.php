<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\CodingStandard\Fixer\Naming\StandardizeHereNowDocKeywordFixer;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    // alternative to CLI arguments, easier to maintain and extend
    $parameters->set(Option::PATHS, [
        __DIR__ . '/app',
        __DIR__ . '/modules',
        __DIR__ . '/tests',
        __DIR__ . '/public',
    ]);

    $parameters->set(Option::SKIP, [
        // TODO: restrict some rules for views?
        __DIR__ . '/app/Views/*',
        __DIR__ . '/modules/**/Views/*',

        // skip specific generated files
        __DIR__ . '/modules/Admin/Language/*/PersonsTaxonomy.php',

        StandardizeHereNowDocKeywordFixer::class => [
            __DIR__ . '/app/View/Components',
            __DIR__ . '/modules/**/View/Components',
        ]
    ]);

    $containerConfigurator->import(SetList::PSR_12);
    $containerConfigurator->import(SetList::SYMPLIFY);
    $containerConfigurator->import(SetList::COMMON);
    $containerConfigurator->import(SetList::CLEAN_CODE);
};
