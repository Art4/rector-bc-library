<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\StringReturnTypeFromStrictScalarReturnsRector\Fixture;

class SomeClass
{
    public function foo()
    {
        if (true) {
            return 'yes';
        }

        return 'no';
    }
}