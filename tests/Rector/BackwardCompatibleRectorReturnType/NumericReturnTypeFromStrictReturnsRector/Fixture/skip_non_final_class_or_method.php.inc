<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\NumericReturnTypeFromStrictReturnsRector\Fixture;

class SomeClass
{
    public function increaseNumber(int $number)
    {
        return ++$number;
    }
}