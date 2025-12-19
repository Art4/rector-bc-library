<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddReturnTypeDeclarationFromYieldsRector\Fixture;

class SomeClass
{
    protected function provide()
    {
        yield 1;
    }
}
