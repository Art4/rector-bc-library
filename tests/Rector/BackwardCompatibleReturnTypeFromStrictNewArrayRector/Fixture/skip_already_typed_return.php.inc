<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictNewArrayRector\Fixture;

final class SkipAlreadyTypedReturn
{
    public function run(): array
    {
        $values = [];

        return $values;
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictNewArrayRector\Fixture;

final class SkipAlreadyTypedReturn
{
    public function run(): array
    {
        $values = [];

        return $values;
    }
}

?>
