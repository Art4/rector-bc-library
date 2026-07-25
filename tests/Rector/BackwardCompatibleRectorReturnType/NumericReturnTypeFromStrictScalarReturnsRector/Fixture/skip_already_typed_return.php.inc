<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\NumericReturnTypeFromStrictScalarReturnsRector\Fixture;

final class SomeClass
{
    public function getNumber(): mixed
    {
        return 200;
    }
}