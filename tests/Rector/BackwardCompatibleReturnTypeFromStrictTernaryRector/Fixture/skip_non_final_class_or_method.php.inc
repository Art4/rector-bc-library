<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictTernaryRector\Fixture;

class SomeClass
{
    public function getValue($number)
    {
        return $number ? 100 : 500;
    }
}
