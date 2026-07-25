<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\AddReturnTypeDeclarationFromYieldsRector\Fixture;

class SomeClass
{
    private function provide()
    {
        yield 1;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\AddReturnTypeDeclarationFromYieldsRector\Fixture;

class SomeClass
{
    private function provide(): \Generator
    {
        yield 1;
    }
}