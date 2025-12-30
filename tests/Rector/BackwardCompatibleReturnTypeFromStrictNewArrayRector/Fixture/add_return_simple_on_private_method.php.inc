<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictNewArrayRector\Fixture;

class SomeClass
{
    private function run()
    {
        $values = [];

        return $values;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictNewArrayRector\Fixture;

class SomeClass
{
    private function run(): array
    {
        $values = [];

        return $values;
    }
}
