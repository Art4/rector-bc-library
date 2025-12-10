<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector\Fixture;

class NonFinalBoolMethod
{
    public function isActive()
    {
        return true;
    }
}

?>
