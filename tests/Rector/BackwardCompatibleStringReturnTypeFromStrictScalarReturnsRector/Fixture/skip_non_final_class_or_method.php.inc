<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStringReturnTypeFromStrictScalarReturnsRector\Fixture;

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
