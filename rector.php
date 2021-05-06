<?php

declare(strict_types=1);

use Rector\CodingStyle\Rector\ClassMethod\UnSpreadOperatorRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\FuncCall\ConsistentPregDelimiterRector;
use Rector\CodingStyle\Rector\String_\SplitStringClassConstantToClassConstFetchRector;
use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersion;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfContinueToMultiContinueRector;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfReturnToEarlyReturnRector;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\Set\ValueObject\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    // get parameters
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::PATHS, [
        __DIR__ . '/app',
        __DIR__ . '/tests',
        __DIR__ . '/public',
    ]);

    // Define what rule sets will be applied
    $parameters->set(Option::SETS, [
        SetList::PHP_73,
        SetList::TYPE_DECLARATION,
        SetList::TYPE_DECLARATION_STRICT,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::EARLY_RETURN,
        SetList::DEAD_CODE,
        SetList::ORDER,
    ]);

    // auto import fully qualified class names
    $parameters->set(Option::AUTO_IMPORT_NAMES, true);
    $parameters->set(Option::ENABLE_CACHE, true);
    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_73);

    $parameters->set(Option::SKIP, [
        // skip specific generated files
        __DIR__ . '/app/Language/*/PersonsTaxonomy.php',

        // skip rules from used sets
        ChangeOrIfReturnToEarlyReturnRector::class,
        ChangeOrIfContinueToMultiContinueRector::class,
        EncapsedStringsToSprintfRector::class,
        SplitStringClassConstantToClassConstFetchRector::class,
        UnSpreadOperatorRector::class,

        // skip rule in specific directory
        StringClassNameToClassConstantRector::class => [
            __DIR__ . '/app/Language/*',
        ],
    ]);

    $services = $containerConfigurator->services();
    $services->set(ConsistentPregDelimiterRector::class)->call('configure', [
        [
            ConsistentPregDelimiterRector::DELIMITER => '~',
        ],
    ]);
};
