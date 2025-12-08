<?php

declare(strict_types=1);

namespace Artur\RectorBcLibrary;

final class Set
{
    /**
     * Path to this package's Rector config.
     * Use this constant in consumer projects to import the set:
     *
     *   $rectorConfig->import(\Artur\RectorBcLibrary\Set::SET);
     */
    public const SET = __DIR__ . '/../rector.php';
}
