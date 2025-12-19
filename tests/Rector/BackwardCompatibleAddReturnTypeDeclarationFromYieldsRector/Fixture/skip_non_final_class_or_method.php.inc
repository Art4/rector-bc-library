<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddReturnTypeDeclarationFromYieldsRector\Fixture;

class SomeClass
{
    public function provide()
    {
        yield 1;
    }
}
