<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictNewArrayRector\Fixture;

final class SomeClass
{
    public function run(): mixed
    {
        $values = [];

        return $values;
    }
}
