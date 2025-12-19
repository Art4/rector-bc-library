<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddReturnTypeDeclarationFromYieldsRector\Fixture;

class SomeClass
{
    final public function provide()
    {
        yield 1;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddReturnTypeDeclarationFromYieldsRector\Fixture;

class SomeClass
{
    final public function provide(): \Generator
    {
        yield 1;
    }
}
