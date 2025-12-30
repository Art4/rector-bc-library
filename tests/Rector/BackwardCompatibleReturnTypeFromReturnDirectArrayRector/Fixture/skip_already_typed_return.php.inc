<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnDirectArrayRector\Fixture;

final class SomeClass
{
    public function getArray(): mixed
    {
        return [1, 2, 3];
    }
}
