<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStringReturnTypeFromStrictScalarReturnsRector\Fixture;

final class SomeClass
{
    public function foo(): mixed
    {
        if (true) {
            return 'yes';
        }

        return 'no';
    }
}
