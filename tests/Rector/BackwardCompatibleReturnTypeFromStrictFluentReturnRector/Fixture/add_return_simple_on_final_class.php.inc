<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictFluentReturnRector\Fixture;

final class SomeClass
{
    public function run()
    {
        return $this;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictFluentReturnRector\Fixture;

final class SomeClass
{
    public function run(): self
    {
        return $this;
    }
}