<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector\Fixture;

class SomeClass
{
    private function checkStatus()
    {
        if ($this->enabled) {
            return true;
        }
        return false;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector\Fixture;

class SomeClass
{
    private function checkStatus(): bool
    {
        if ($this->enabled) {
            return true;
        }
        return false;
    }
}
