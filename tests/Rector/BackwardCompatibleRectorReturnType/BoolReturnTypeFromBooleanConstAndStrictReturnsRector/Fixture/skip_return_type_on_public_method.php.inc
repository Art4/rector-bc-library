<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanConstAndStrictReturnsRector\Fixture;

class OpenClass
{
    public function resolve(array $value)
    {
        if ($value === []) {
            return true;
        }

        return count($value) > 0;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanConstAndStrictReturnsRector\Fixture;

class OpenClass
{
    public function resolve(array $value)
    {
        if ($value === []) {
            return true;
        }

        return count($value) > 0;
    }
}
