<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanConstReturnsRector\Fixture;

final class SomeClass
{
    public function isActive(): mixed
    {
        return true;
    }
}