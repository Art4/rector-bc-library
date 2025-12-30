<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStringReturnTypeFromStrictStringReturnsRector\Fixture;

final class SomeClass
{
    public function foo($value): mixed
    {
        if ($value) {
            return 'yes';
        }

        return strtoupper($value);
    }
}
