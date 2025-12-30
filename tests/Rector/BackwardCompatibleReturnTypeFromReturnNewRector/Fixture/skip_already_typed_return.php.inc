<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnNewRector\Fixture;

final class SomeClass
{
    public function create(): mixed
    {
        return new \stdClass();
    }
}
