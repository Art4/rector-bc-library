<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanConstReturnsRector\Fixture;

class SomeClass
{
    final public function isActive()
    {
        return true;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanConstReturnsRector\Fixture;

class SomeClass
{
    final public function isActive(): bool
    {
        return true;
    }
}