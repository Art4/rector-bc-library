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

    $rectorConfig->rule(BackwardCompatibleRector::class);
    $rectorConfig->rules(Set::getTypeDeclarationRules());
};
