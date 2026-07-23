<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictNewArrayRector\Fixture;

final class SomeClass
{
    public function run(): mixed
    {
        $values = [];

        return $values;
    }
}