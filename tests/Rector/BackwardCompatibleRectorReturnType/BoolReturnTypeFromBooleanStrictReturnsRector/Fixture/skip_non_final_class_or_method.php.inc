<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanStrictReturnsRector\Fixture;

class SomeClass
{
    public function isGreater($first, $second)
    {
        return $first > $second;
    }
}