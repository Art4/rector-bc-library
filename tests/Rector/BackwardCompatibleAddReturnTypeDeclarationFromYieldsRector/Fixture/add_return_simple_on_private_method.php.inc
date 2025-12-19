<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddReturnTypeDeclarationFromYieldsRector\Fixture;

class SomeClass
{
    private function provide()
    {
        yield 1;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddReturnTypeDeclarationFromYieldsRector\Fixture;

class SomeClass
{
    private function provide(): \Generator
    {
        yield 1;
    }
}
