<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\AddVoidReturnTypeWhereNoReturnRector\Fixture;

class SomeClass
{
    public function getValues()
    {
        $value = 1000;
        return;
    }
}