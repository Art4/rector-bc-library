<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictNewArrayRector\Fixture;

class SomeClass
{
    public function run()
    {
        $values = [];

        return $values;
    }
}