<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

/**
 * This file exposes the Rector configuration for this package.
 *
 * Consumers can import it from their `rector.php` via:
 *
 *   $rectorConfig->import(\Art4\RectorBcLibrary\Set::SET);
 *
 * The closure will be executed by Rector in the consuming project (so Rector
 * must be installed there). Keep this file minimal and avoid referencing
 * runtime globals.
 */

return static function (RectorConfig $rectorConfig): void {
    // register specific rules or sets here, for example:
    // $rectorConfig->rule(\SomeVendor\SomeRector::class);
    // $rectorConfig->rules([ ... ]);
    // $rectorConfig->sets([ ... ]);

    // Register our backward-compatible wrappers for the original Rector rules
    // and skip the original Rector rules so only this package's wrappers run.
    $rectorConfig->rule(\Art4\RectorBcLibrary\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector::class);
    $rectorConfig->rule(\Art4\RectorBcLibrary\Rector\BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector::class);
    $rectorConfig->rule(\Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector::class);
    $rectorConfig->rule(\Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictNewArrayRector::class);
    $rectorConfig->rule(\Art4\RectorBcLibrary\Rector\BackwardCompatibilityReturnTypeFromReturnNewRector::class);
    $rectorConfig->rule(\Art4\RectorBcLibrary\Rector\BackwardCompatibleStringReturnTypeFromStrictScalarReturnsRector::class);
    $rectorConfig->rule(\Art4\RectorBcLibrary\Rector\BackwardCompatibleStringReturnTypeFromStrictStringReturnsRector::class);

    // Make the original Rector rule skip to avoid duplicate/conflicting behaviour
    $rectorConfig->skip([
        \Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanConstReturnsRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanStrictReturnsRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictConstantReturnRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNewArrayRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnNewRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\StringReturnTypeFromStrictScalarReturnsRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\StringReturnTypeFromStrictStringReturnsRector::class,
    ]);
};
