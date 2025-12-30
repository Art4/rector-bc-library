<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleNumericReturnTypeFromStrictScalarReturnsRector\Fixture;

final class SomeClass
{
    public function getNumber()
    {
        return 200;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleNumericReturnTypeFromStrictScalarReturnsRector\Fixture;

final class SomeClass
{
    public function getNumber(): int
    {
        return 200;
    }
}
