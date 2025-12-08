<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary;

final class Set
{
    /**
     * Path to this package's Rector config.
     * Use this constant in consumer projects to import the set:
     *
     *   $rectorConfig->import(\Art4\RectorBcLibrary\Set::SET);
     */
    public const SET = __DIR__ . '/../rector.php';
}
