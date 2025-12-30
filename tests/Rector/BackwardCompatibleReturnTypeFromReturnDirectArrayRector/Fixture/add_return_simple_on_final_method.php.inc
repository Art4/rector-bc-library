<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnDirectArrayRector\Fixture;

class SomeClass
{
    final public function getArray()
    {
        return [1, 2, 3];
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnDirectArrayRector\Fixture;

class SomeClass
{
    final public function getArray(): array
    {
        return [1, 2, 3];
    }
}
