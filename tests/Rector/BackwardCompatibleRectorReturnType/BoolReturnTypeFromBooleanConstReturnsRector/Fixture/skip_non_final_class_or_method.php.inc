<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanConstReturnsRector\Fixture;

class SomeClass
{
    public function isActive()
    {
        return true;
    }
}