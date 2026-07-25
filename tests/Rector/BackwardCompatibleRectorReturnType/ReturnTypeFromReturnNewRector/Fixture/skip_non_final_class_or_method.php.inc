<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromReturnNewRector\Fixture;

class SomeClass
{
    public function create()
    {
        return new \stdClass();
    }
}