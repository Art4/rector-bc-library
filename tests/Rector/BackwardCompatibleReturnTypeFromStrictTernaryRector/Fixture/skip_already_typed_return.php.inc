<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictTernaryRector\Fixture;

final class SomeClass
{
    public function getValue($number): mixed
    {
        return $number ? 100 : 500;
    }
}
