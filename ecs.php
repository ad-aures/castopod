<?php

use PhpCsFixer\Fixer\Whitespace\IndentationTypeFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\CodingStandard\Fixer\Naming\StandardizeHereNowDocKeywordFixer;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    // alternative to CLI arguments, easier to maintain and extend
    $parameters->set(Option::PATHS, [
        __DIR__ . '/app',
        __DIR__ . '/modules',
        __DIR__ . '/themes',
        __DIR__ . '/tests',
        __DIR__ . '/public',
    ]);

    $parameters->set(Option::SKIP, [        
        // skip specific generated files
        __DIR__ . '/modules/Admin/Language/*/PersonsTaxonomy.php',

        StandardizeHereNowDocKeywordFixer::class => [
            __DIR__ . '/app/Views/Components/*',
            __DIR__ . '/modules/**/Views/Components/*',
            __DIR__ . '/themes/**/Views/Components/*',
        ],

        LineLengthFixer::class => [
            __DIR__ . '/app/Views/*',
            __DIR__ . '/modules/**/Views/*',
            __DIR__ . '/themes/*',
        ],

        IndentationTypeFixer::class => [
            __DIR__ . '/app/Views/*',
            __DIR__ . '/modules/**/Views/*',
            __DIR__ . '/themes/*',
        ],

        // crowdin enforces its own style for translation files
        // remove SingleQuoteFixer for Language files to prevent conflicts
        SingleQuoteFixer::class => [
            __DIR__ . '/app/Language/*',
            __DIR__ . '/modules/**/Language/*'
        ],

        AssignmentInConditionSniff::class,
    ]);

    $containerConfigurator->import(SetList::PSR_12);
    $containerConfigurator->import(SetList::SYMPLIFY);
    $containerConfigurator->import(SetList::COMMON);
    $containerConfigurator->import(SetList::CLEAN_CODE);
};
