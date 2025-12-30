<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictFluentReturnRector\Fixture;

class SomeClass
{
    final public function run()
    {
        return $this;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictFluentReturnRector\Fixture;

class SomeClass
{
    final public function run(): static
    {
        return $this;
    }
}
