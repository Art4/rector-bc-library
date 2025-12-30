<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleNumericReturnTypeFromStrictScalarReturnsRector\Fixture;

class SomeClass
{
    private function getNumber()
    {
        return 200;
    }

    public function getAnotherNumber()
    {
        return 300;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleNumericReturnTypeFromStrictScalarReturnsRector\Fixture;

class SomeClass
{
    private function getNumber(): int
    {
        return 200;
    }

    public function getAnotherNumber()
    {
        return 300;
    }
}
