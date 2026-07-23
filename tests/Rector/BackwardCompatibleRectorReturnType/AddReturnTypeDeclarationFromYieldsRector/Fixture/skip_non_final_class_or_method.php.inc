<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\AddReturnTypeDeclarationFromYieldsRector\Fixture;

class SomeClass
{
    public function provide()
    {
        yield 1;
    }
}