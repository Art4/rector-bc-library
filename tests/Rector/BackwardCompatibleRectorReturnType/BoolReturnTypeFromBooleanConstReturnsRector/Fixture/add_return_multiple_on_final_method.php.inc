<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanConstReturnsRector\Fixture;

class SomeClass
{
    final public function checkStatus()
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

class SomeClass
{
    final public function checkStatus(): bool
    {
        if ($this->enabled) {
            return true;
        }
        return false;
    }
}