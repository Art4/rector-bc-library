<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromReturnDirectArrayRector\Fixture;

final class SomeClass
{
    public function getArray(): mixed
    {
        return [1, 2, 3];
    }
}