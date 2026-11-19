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
    // Deprecated rules are not skipped: no set registers them any more, and Rector
    // warns "Skipped rule ... is deprecated" for each of them.
    $wrappedOriginals = array_values(array_filter(
        array_keys(Set::getRuleGuardMap()),
        static fn(string $rule): bool => class_exists($rule)
            && !is_a($rule, \Rector\Configuration\Deprecation\Contract\DeprecatedInterface::class, true)
    ));

    $rectorConfig->skip($wrappedOriginals);

    // Register the skipped originals as well. Rector reports a skipped rule that is
    // never registered ("skipped rules are never registered") and `validate-config`
    // then fails. The skip above keeps them inert, they never run on their own.
    $rectorConfig->rules($wrappedOriginals);

    $rectorConfig->rule(BackwardCompatibleRector::class);
    $rectorConfig->rules(Set::getTypeDeclarationRules());
};
