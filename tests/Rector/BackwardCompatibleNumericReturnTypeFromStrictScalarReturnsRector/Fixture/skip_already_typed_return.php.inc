<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleNumericReturnTypeFromStrictScalarReturnsRector\Fixture;

final class SomeClass
{
    public function getNumber(): mixed
    {
        return 200;
    }
}
