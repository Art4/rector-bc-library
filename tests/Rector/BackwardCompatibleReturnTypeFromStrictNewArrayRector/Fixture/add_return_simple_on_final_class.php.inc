<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictNewArrayRector\Fixture;

final class SomeClass
{
    public function run()
    {
        $values = [];

        return $values;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictNewArrayRector\Fixture;

final class SomeClass
{
    public function run(): array
    {
        $values = [];

        return $values;
    }
}
