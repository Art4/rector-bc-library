<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Art4\RectorBcLibrary\Set;
use Rector\Config\RectorConfig;

/**
 * This file exposes the Rector configuration for this package.
 *
 * Consumers can import it from their `rector.php` via:
 *
 *   $rectorConfig->import(\Art4\RectorBcLibrary\Set::BC_TYPE_DECLARATION);
 *
 * The closure will be executed by Rector in the consuming project (so Rector
 * must be installed there). Keep this file minimal and avoid referencing
 * runtime globals.
 */

return static function (RectorConfig $rectorConfig): void {
    BackwardCompatibleRector::setContainer($rectorConfig);

    foreach (Set::getRuleGuardMap() as $originalRectorClass => $guard) {
        BackwardCompatibleRector::addRuleConfiguration($originalRectorClass, $guard);
    }

    // The wrapper runs the original rules itself, behind its guards. Skip them in
    // Rector, so another set (e.g. withPhpSets(php81: true) registering
    // ReturnNeverTypeRector) can't run the unguarded original on its own.
    // skip() asserts the class exists, which it may not on an older Rector release.
    $rectorConfig->skip(array_values(array_filter(
        array_keys(Set::getRuleGuardMap()),
        static fn(string $rule): bool => class_exists($rule)
    )));

    $rectorConfig->rule(BackwardCompatibleRector::class);
    $rectorConfig->rules(Set::getTypeDeclarationRules());
};
