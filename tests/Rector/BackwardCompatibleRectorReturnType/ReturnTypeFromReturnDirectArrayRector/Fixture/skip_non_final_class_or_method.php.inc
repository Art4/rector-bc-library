<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromReturnDirectArrayRector\Fixture;

class SomeClass
{
    public function getArray()
    {
        return [1, 2, 3];
    }
}