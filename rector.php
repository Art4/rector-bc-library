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

    // Example: register the example rule provided in this package while
    // developing rules in this repository.
    $rectorConfig->rule(\Art4\RectorBcLibrary\Rector\ExampleRector::class);
};
