<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictNewArrayRector\Fixture;

class SomeClass
{
    final public function run()
    {
        $values = [];

        return $values;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictNewArrayRector\Fixture;

class SomeClass
{
    final public function run(): array
    {
        $values = [];

        return $values;
    }
}