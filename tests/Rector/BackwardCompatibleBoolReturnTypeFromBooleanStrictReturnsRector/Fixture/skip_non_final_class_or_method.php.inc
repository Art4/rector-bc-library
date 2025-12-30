<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector\Fixture;

class SomeClass
{
    public function isGreater($first, $second)
    {
        return $first > $second;
    }
}
