<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleNumericReturnTypeFromStrictReturnsRector\Fixture;

final class SomeClass
{
    public function increaseNumber(int $number): mixed
    {
        return ++$number;
    }
}
