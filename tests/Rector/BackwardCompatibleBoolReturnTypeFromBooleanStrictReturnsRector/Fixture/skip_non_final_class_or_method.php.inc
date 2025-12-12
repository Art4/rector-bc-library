<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector\Fixture;

class NonFinalStrictBoolClass
{
    public function isGreater($first, $second)
    {
        return $first > $second;
    }
}

?>
