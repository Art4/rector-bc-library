<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanConstAndStrictReturnsRector\Fixture;

class FinalMethod
{
    final public function resolve(array $value)
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

class FinalMethod
{
    final public function resolve(array $value): bool
    {
        if ($value === []) {
            return true;
        }

        return count($value) > 0;
    }
}
