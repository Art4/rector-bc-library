<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\StringReturnTypeFromStrictStringReturnsRector\Fixture;

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