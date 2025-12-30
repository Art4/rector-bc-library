<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector\Fixture;

final class SomeClass
{
    public function isActive(): mixed
    {
        return true;
    }
}
