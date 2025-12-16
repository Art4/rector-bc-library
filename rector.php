<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Configuration\Option;
use Rector\Configuration\Parameter\SimpleParameterProvider;

/**
 * This file exposes the Rector configuration for this package.
 *
 * Consumers can import it from their `rector.php` via:
 *
 *   $rectorConfig->import(\Art4\RectorBcLibrary\Set::ALL);
 *
 * The closure will be executed by Rector in the consuming project (so Rector
 * must be installed there). Keep this file minimal and avoid referencing
 * runtime globals.
 */

return static function (RectorConfig $rectorConfig): void {
    $ruleMap = [
        \Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleAddVoidReturnTypeWhereNoReturnRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanConstReturnsRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanStrictReturnsRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnNewRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromReturnNewRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictConstantReturnRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNewArrayRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictNewArrayRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\StringReturnTypeFromStrictScalarReturnsRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleStringReturnTypeFromStrictScalarReturnsRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\StringReturnTypeFromStrictStringReturnsRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleStringReturnTypeFromStrictStringReturnsRector::class,
    ];

    $registeredRectorRules = SimpleParameterProvider::provideArrayParameter(Option::REGISTERED_RECTOR_RULES);

    foreach ($ruleMap as $original => $wrapper) {
        if (! class_exists($original)) {
            continue;
        }

        if (! in_array($original, $registeredRectorRules, true)) {
            // Original rule is not registered, so skip wrapping it.
            continue;
        }

        // Register our backward-compatible wrappers for the original Rector rules…
        $rectorConfig->rule($wrapper);

        // …and skip the original Rector rules so only this package's wrappers run.
        $rectorConfig->skip([$original]);
    }
};
