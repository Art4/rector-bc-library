<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictFluentReturnRector\Fixture;

class SomeClass
{
    private function run()
    {
        return $this;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictFluentReturnRector\Fixture;

class SomeClass
{
    private function run(): static
    {
        return $this;
    }
}
