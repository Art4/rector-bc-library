<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\NumericReturnTypeFromStrictReturnsRector\Fixture;

final class SomeClass
{
    public function increaseNumber(int $number)
    {
        return ++$number;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\NumericReturnTypeFromStrictReturnsRector\Fixture;

final class SomeClass
{
    public function increaseNumber(int $number): int
    {
        return ++$number;
    }
}