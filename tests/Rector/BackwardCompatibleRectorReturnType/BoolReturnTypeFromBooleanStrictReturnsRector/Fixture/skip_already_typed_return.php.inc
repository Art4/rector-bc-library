<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanStrictReturnsRector\Fixture;

final class SomeClass
{
    public function isGreater($first, $second): mixed
    {
        return $first > $second;
    }
}