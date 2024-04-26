<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;
use PhpCsFixer\Fixer\Whitespace\IndentationTypeFixer;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\CodingStandard\Fixer\Naming\StandardizeHereNowDocKeywordFixer;
use Symplify\CodingStandard\Fixer\Spacing\MethodChainingNewlineFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths([
        __DIR__ . '/app',
        __DIR__ . '/modules',
        __DIR__ . '/themes',
        __DIR__ . '/tests',
        __DIR__ . '/public',
        __DIR__ . '/builds',
        __DIR__ . '/spark',
    ])
    ->withRootFiles()
    ->withPreparedSets(cleanCode: true, common: true, symplify: true, strict: true, psr12: true)
    ->withSkip([
        // skip specific generated files
        __DIR__ . '/modules/Admin/Language/*/PersonsTaxonomy.php',

        StandardizeHereNowDocKeywordFixer::class => [
            __DIR__ . '/app/Views/Components/*',
            __DIR__ . '/modules/**/Views/Components/*',
            __DIR__ . '/themes/**/Views/Components/*',
            __DIR__ . '/app/Helpers/components_helper.php',
        ],

        LineLengthFixer::class => [__DIR__ . '/app/Views/*', __DIR__ . '/modules/**/Views/*', __DIR__ . '/themes/*'],

        IndentationTypeFixer::class => [
            __DIR__ . '/app/Views/*',
            __DIR__ . '/modules/**/Views/*',
            __DIR__ . '/themes/*',
        ],

        MethodChainingNewlineFixer::class => [
            __DIR__ . '/app/Views/*',
            __DIR__ . '/modules/**/Views/*',
            __DIR__ . '/themes/*',
        ],

        // crowdin enforces its own style for translation files
        // remove SingleQuoteFixer for Language files to prevent conflicts
        SingleQuoteFixer::class => [__DIR__ . '/app/Language/*', __DIR__ . '/modules/**/Language/*'],

        BinaryOperatorSpacesFixer::class => [__DIR__ . '/app/Language/*', __DIR__ . '/modules/**/Language/*'],

        AssignmentInConditionSniff::class,
    ])
    ->withConfiguredRule(BinaryOperatorSpacesFixer::class, [
        'operators' => [
            '=>' => 'align_single_space_minimal',
        ],
    ]);
