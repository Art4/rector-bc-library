<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleNumericReturnTypeFromStrictReturnsRector\Fixture;

class SomeClass
{
    public function increaseNumber(int $number)
    {
        return ++$number;
    }
}
