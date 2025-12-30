<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictNewArrayRector\Fixture;

class SomeClass
{
    public function run()
    {
        $values = [];

        return $values;
    }
}
