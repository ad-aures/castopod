<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\PropertyFetch\ExplicitMethodCallOverMagicGetSetRector;
use Rector\CodingStyle\Rector\ClassMethod\UnSpreadOperatorRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\FuncCall\ConsistentPregDelimiterRector;
use Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector;
use Rector\CodingStyle\Rector\String_\SymplifyQuoteEscapeRector;
use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\DeadCode\Rector\If_\UnwrapFutureCompatibleIfPhpVersionRector;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfContinueToMultiContinueRector;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfReturnToEarlyReturnRector;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\Php71\Rector\FuncCall\RemoveExtraParametersRector;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([__DIR__ . '/app', __DIR__ . '/modules', __DIR__ . '/tests', __DIR__ . '/public']);

    // do you need to include constants, class aliases or custom autoloader? files listed will be executed
    $rectorConfig->bootstrapFiles([__DIR__ . '/vendor/codeigniter4/framework/system/Test/bootstrap.php']);

    // Define what rule sets will be applied
    $rectorConfig->sets([
        SetList::PHP_81,
        SetList::TYPE_DECLARATION,
        SetList::TYPE_DECLARATION_STRICT,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::EARLY_RETURN,
        SetList::DEAD_CODE,
    ]);

    // auto import fully qualified class names
    $rectorConfig->importNames();

    $rectorConfig->phpVersion(PhpVersion::PHP_81);

    $rectorConfig->skip([
        // .mp3 files were somehow processed by rector, so skip all media files
        __DIR__ . '/public/media/*',

        __DIR__ . '/app/Views/errors/*',

        // skip specific generated files
        __DIR__ . '/modules/Admin/Language/*/PersonsTaxonomy.php',

        // skip rules from used sets
        ChangeOrIfReturnToEarlyReturnRector::class,
        ChangeOrIfContinueToMultiContinueRector::class,
        EncapsedStringsToSprintfRector::class,
        UnSpreadOperatorRector::class,
        ExplicitMethodCallOverMagicGetSetRector::class,
        RemoveExtraParametersRector::class,
        UnwrapFutureCompatibleIfPhpVersionRector::class,

        // skip rule in specific directory
        StringClassNameToClassConstantRector::class => [
            __DIR__ . '/app/Language/*',
            __DIR__ . '/modules/*/Language/*',
        ],
        SymplifyQuoteEscapeRector::class => [__DIR__ . '/app/Language/*', __DIR__ . '/modules/*/Language/*'],

        NewlineAfterStatementRector::class => [__DIR__ . '/app/Views'],
    ]);

    // Path to phpstan with extensions, that PHPStan in Rector uses to determine types
    $rectorConfig->phpstanConfig(__DIR__ . '/phpstan.neon');

    $rectorConfig->ruleWithConfiguration(ConsistentPregDelimiterRector::class, [
        ConsistentPregDelimiterRector::DELIMITER => '~',
    ]);
};
