<?php

declare(strict_types=1);

use Rector\CodingStyle\Rector\ClassMethod\UnSpreadOperatorRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\FuncCall\CallUserFuncArrayToVariadicRector;
use Rector\CodingStyle\Rector\FuncCall\ConsistentPregDelimiterRector;
use Rector\CodingStyle\Rector\FuncCall\VersionCompareFuncCallToConstantRector;
use Rector\CodingStyle\Rector\String_\SplitStringClassConstantToClassConstFetchRector;
use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersion;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfContinueToMultiContinueRector;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfReturnToEarlyReturnRector;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\Php80\Rector\ClassMethod\OptionalParametersAfterRequiredRector;
use Rector\Set\ValueObject\SetList;
use Rector\Transform\Rector\FuncCall\FuncCallToConstFetchRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    // get parameters
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::PATHS, [
        __DIR__ . '/app',
        __DIR__ . '/modules',
        __DIR__ . '/tests',
        __DIR__ . '/public',
    ]);

    // do you need to include constants, class aliases or custom autoloader? files listed will be executed
    $parameters->set(Option::BOOTSTRAP_FILES, [
        __DIR__ . '/vendor/codeigniter4/codeigniter4/system/Test/bootstrap.php',
    ]);

    // Define what rule sets will be applied
    $containerConfigurator->import(SetList::PHP_80);
    $containerConfigurator->import(SetList::TYPE_DECLARATION);
    $containerConfigurator->import(SetList::TYPE_DECLARATION_STRICT);
    $containerConfigurator->import(SetList::CODE_QUALITY);
    $containerConfigurator->import(SetList::CODING_STYLE);
    $containerConfigurator->import(SetList::EARLY_RETURN);
    $containerConfigurator->import(SetList::DEAD_CODE);
    $containerConfigurator->import(SetList::ORDER);

    // auto import fully qualified class names
    $parameters->set(Option::AUTO_IMPORT_NAMES, true);
    // $parameters->set(Option::ENABLE_CACHE, true);
    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_80);

    $parameters->set(Option::SKIP, [
        // skip specific generated files
        __DIR__ . '/modules/Admin/Language/*/PersonsTaxonomy.php',

        // skip rules from used sets
        ChangeOrIfReturnToEarlyReturnRector::class,
        ChangeOrIfContinueToMultiContinueRector::class,
        EncapsedStringsToSprintfRector::class,
        SplitStringClassConstantToClassConstFetchRector::class,
        UnSpreadOperatorRector::class,

        // skip rule in specific directory
        StringClassNameToClassConstantRector::class => [
            __DIR__ . '/app/Language/*',
            __DIR__ . '/modules/*/Language/*',
        ],
        OptionalParametersAfterRequiredRector::class => [
            __DIR__ . '/app/Validation',
        ],
    ]);

    // Path to phpstan with extensions, that PHPStan in Rector uses to determine types
    $parameters->set(
        Option::PHPSTAN_FOR_RECTOR_PATH,
        __DIR__ . '/phpstan.neon',
    );

    $services = $containerConfigurator->services();
    $services->set(ConsistentPregDelimiterRector::class)->call('configure', [
        [
            ConsistentPregDelimiterRector::DELIMITER => '~',
        ],
    ]);
};
