<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\AddReturnTypeDeclarationFromYieldsRector\Fixture;

class SomeClass
{
    protected function provide()
    {
        yield 1;
    }
}