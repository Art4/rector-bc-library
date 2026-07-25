<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromReturnNewRector\Fixture;

final class SomeClass
{
    public function create(): mixed
    {
        return new \stdClass();
    }
}