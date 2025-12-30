<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleNumericReturnTypeFromStrictReturnsRector\Fixture;

final class SomeClass
{
    public function increaseNumber(int $number)
    {
        return ++$number;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleNumericReturnTypeFromStrictReturnsRector\Fixture;

final class SomeClass
{
    public function increaseNumber(int $number): int
    {
        return ++$number;
    }
}
