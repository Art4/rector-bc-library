<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanStrictReturnsRector\Fixture;

class SomeClass
{
    final public function isGreater($first, $second)
    {
        return $first > $second;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanStrictReturnsRector\Fixture;

class SomeClass
{
    final public function isGreater($first, $second): bool
    {
        return $first > $second;
    }
}