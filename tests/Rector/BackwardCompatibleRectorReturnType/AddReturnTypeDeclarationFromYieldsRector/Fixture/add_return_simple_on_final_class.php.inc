<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\AddReturnTypeDeclarationFromYieldsRector\Fixture;

final class SomeClass
{
    public function provide()
    {
        yield 1;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\AddReturnTypeDeclarationFromYieldsRector\Fixture;

final class SomeClass
{
    public function provide(): \Generator
    {
        yield 1;
    }
}