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

    // Register our backward-compatible wrapper for the ReturnTypeFromStrictConstantReturnRector
    // and skip the original Rector rule so only this package's wrapper runs.
    $rectorConfig->rule(\Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector::class);

    // Make the original Rector rule skip to avoid duplicate/conflicting behaviour
    $rectorConfig->skip([
        \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictConstantReturnRector::class,
    ]);
};
