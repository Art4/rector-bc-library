<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector\Fixture;

class SomeClass
{
    private function isActive()
    {
        return true;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector\Fixture;

class SomeClass
{
    private function isActive(): bool
    {
        return true;
    }
}
