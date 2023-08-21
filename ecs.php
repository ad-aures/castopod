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
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {
    // alternative to CLI arguments, easier to maintain and extend
    $ecsConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/modules',
        __DIR__ . '/themes',
        __DIR__ . '/tests',
        __DIR__ . '/public',
        __DIR__ . '/builds',
        __DIR__ . '/ecs.php',
        __DIR__ . '/preload.php',
        __DIR__ . '/rector.php',
        __DIR__ . '/spark',
    ]);

    $ecsConfig->sets([SetList::CLEAN_CODE, SetList::COMMON, SetList::SYMPLIFY, SetList::PSR_12]);

    $ecsConfig->skip([
        // skip specific generated files
        __DIR__ . '/modules/Admin/Language/*/PersonsTaxonomy.php',

        StandardizeHereNowDocKeywordFixer::class => [
            __DIR__ . '/app/Views/Components/*',
            __DIR__ . '/modules/**/Views/Components/*',
            __DIR__ . '/themes/**/Views/Components/*',
            __DIR__ . '/app/Helpers/components_helper.php',
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
    ]);

    $ecsConfig->ruleWithConfiguration(BinaryOperatorSpacesFixer::class, [
        'operators' => [
            '=>' => 'align_single_space_minimal',
        ],
    ]);
};
