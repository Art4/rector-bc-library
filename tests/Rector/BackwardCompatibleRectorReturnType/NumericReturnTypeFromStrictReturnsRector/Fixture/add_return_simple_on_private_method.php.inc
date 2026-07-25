<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\NumericReturnTypeFromStrictReturnsRector\Fixture;

class SomeClass
{
    private function increaseNumber(int $number)
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

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\NumericReturnTypeFromStrictReturnsRector\Fixture;

class SomeClass
{
    private function increaseNumber(int $number): int
    {
        return ++$number;
    }

    public function decreaseNumber(int $number)
    {
        return --$number;
    }
}