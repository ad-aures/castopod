<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\ClassMethod\ExplicitReturnNullRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector;
use Rector\CodingStyle\Rector\String_\SimplifyQuoteEscapeRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\If_\UnwrapFutureCompatibleIfPhpVersionRector;
use Rector\DeadCode\Rector\Stmt\RemoveUnreachableStatementRector;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfContinueToMultiContinueRector;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\Php71\Rector\FuncCall\RemoveExtraParametersRector;
use Rector\ValueObject\PhpVersion;

return RectorConfig::configure()
    ->withPaths([__DIR__ . '/app', __DIR__ . '/modules', __DIR__ . '/tests', __DIR__ . '/public'])
    ->withBootstrapFiles([__DIR__ . '/vendor/codeigniter4/framework/system/Test/bootstrap.php'])
    ->withPhpVersion(PhpVersion::PHP_85)
    ->withPhpSets(php85: true)
    ->withPreparedSets(
        typeDeclarations: true,
        codeQuality: true,
        codingStyle: true,
        earlyReturn: true,
        deadCode: true,
    )
    ->withImportNames(true, true, true, true)
    ->withSkip([
        // .mp3 files were somehow processed by rector, so skip all media files
        __DIR__ . '/public/media/*',

        __DIR__ . '/app/Views/errors/*',

        // skip specific generated files
        __DIR__ . '/modules/Admin/Language/*/PersonsTaxonomy.php',

        // skip rules from used sets
        ChangeOrIfContinueToMultiContinueRector::class,
        EncapsedStringsToSprintfRector::class,
        RemoveExtraParametersRector::class,
        UnwrapFutureCompatibleIfPhpVersionRector::class,
        ExplicitReturnNullRector::class,

        // skip rule in specific directory
        StringClassNameToClassConstantRector::class => [
            __DIR__ . '/app/Language/*',
            __DIR__ . '/modules/*/Language/*',
        ],
        SimplifyQuoteEscapeRector::class => [__DIR__ . '/app/Language/*', __DIR__ . '/modules/*/Language/*'],

        NewlineAfterStatementRector::class => [__DIR__ . '/app/Views'],

        RemoveUnreachableStatementRector::class => [
            __DIR__ . '/modules/Install/Controllers/InstallController.php',
        ],
    ])
    ->withPHPStanConfigs([__DIR__ . '/phpstan.neon', 'vendor/codeigniter/phpstan-codeigniter/extension.neon']);
