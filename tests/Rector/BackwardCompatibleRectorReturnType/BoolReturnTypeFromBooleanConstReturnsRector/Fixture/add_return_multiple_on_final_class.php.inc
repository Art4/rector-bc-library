<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanConstReturnsRector\Fixture;

final class SomeClass
{
    public function checkStatus()
    {
        if ($this->enabled) {
            return true;
        }
        return false;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanConstReturnsRector\Fixture;

final class SomeClass
{
    public function checkStatus(): bool
    {
        if ($this->enabled) {
            return true;
        }
        return false;
    }
}