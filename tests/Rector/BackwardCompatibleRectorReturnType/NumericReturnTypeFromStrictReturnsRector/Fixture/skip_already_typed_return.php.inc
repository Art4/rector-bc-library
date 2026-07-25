<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\NumericReturnTypeFromStrictReturnsRector\Fixture;

final class SomeClass
{
    public function increaseNumber(int $number): mixed
    {
        return ++$number;
    }
}