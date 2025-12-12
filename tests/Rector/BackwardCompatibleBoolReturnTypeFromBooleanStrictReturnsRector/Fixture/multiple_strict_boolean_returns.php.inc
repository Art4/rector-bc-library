<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector\Fixture;

final class MultipleStrictBooleanReturns
{
    final public function check($a, $b)
    {
        if ($a > $b) {
            return $a > $b;
        }
        return $a < $b;
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector\Fixture;

final class MultipleStrictBooleanReturns
{
    final public function check($a, $b): bool
    {
        if ($a > $b) {
            return $a > $b;
        }
        return $a < $b;
    }
}

?>
