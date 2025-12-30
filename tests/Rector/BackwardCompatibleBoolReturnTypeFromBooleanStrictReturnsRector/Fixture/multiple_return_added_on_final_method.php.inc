<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector\Fixture;

class SomeClass
{
    final public function check($a, $b)
    {
        if ($a > $b) {
            return $a > $b;
        }
        return $a < $b;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector\Fixture;

class SomeClass
{
    final public function check($a, $b): bool
    {
        if ($a > $b) {
            return $a > $b;
        }
        return $a < $b;
    }
}
