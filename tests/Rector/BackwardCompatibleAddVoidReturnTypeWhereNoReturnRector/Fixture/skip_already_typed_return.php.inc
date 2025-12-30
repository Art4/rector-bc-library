<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddVoidReturnTypeWhereNoReturnRector\Fixture;

final class SomeClass
{
    public function getValues(): void
    {
        $value = 1000;
        return;
    }
}
