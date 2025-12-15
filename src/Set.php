<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary;

final class Set
{
    /**
     * Path to this package's Rector config.
     * Use this constant in consumer projects to import the set:
     *
     *   RectorConfig::configure()->withSets([\Art4\RectorBcLibrary\Set::ALL]);
     */
    public const ALL = __DIR__ . '/../rector.php';
}
