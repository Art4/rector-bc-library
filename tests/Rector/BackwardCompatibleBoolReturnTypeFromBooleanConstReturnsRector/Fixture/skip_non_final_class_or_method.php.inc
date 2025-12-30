<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector\Fixture;

class SomeClass
{
    public function isActive()
    {
        return true;
    }
}
