<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnDirectArrayRector\Fixture;

final class SomeClass
{
    public function getArray()
    {
        return [1, 2, 3];
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnDirectArrayRector\Fixture;

final class SomeClass
{
    public function getArray(): array
    {
        return [1, 2, 3];
    }
}
