<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictTernaryRector\Fixture;

class SomeClass
{
    final public function getValue($number)
    {
        return $number ? 100 : 500;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictTernaryRector\Fixture;

class SomeClass
{
    final public function getValue($number): int
    {
        return $number ? 100 : 500;
    }
}