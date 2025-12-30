<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector\Fixture;

final class SomeClass
{
    public function isGreater($first, $second): mixed
    {
        return $first > $second;
    }
}
