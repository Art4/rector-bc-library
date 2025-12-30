<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleNumericReturnTypeFromStrictReturnsRector\Fixture;

class SomeClass
{
    final public function increaseNumber(int $number)
    {
        return ++$number;
    }

    public function decreaseNumber(int $number)
    {
        return --$number;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleNumericReturnTypeFromStrictReturnsRector\Fixture;

class SomeClass
{
    final public function increaseNumber(int $number): int
    {
        return ++$number;
    }

    public function decreaseNumber(int $number)
    {
        return --$number;
    }
}
