<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddVoidReturnTypeWhereNoReturnRector\Fixture;

class SomeClass
{
    public function getValues()
    {
        $value = 1000;
        return;
    }
}
