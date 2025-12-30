<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnNewRector\Fixture;

class SomeClass
{
    final public function create()
    {
        return new \stdClass();
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnNewRector\Fixture;

class SomeClass
{
    final public function create(): \stdClass
    {
        return new \stdClass();
    }
}
