<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStringReturnTypeFromStrictStringReturnsRector\Fixture;

class SomeClass
{
    public function foo($value)
    {
        if ($value) {
            return 'yes';
        }

        return strtoupper($value);
    }
}
