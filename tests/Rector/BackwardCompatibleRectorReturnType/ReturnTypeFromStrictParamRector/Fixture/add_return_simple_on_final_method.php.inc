<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictParamRector\Fixture;

class SomeClass
{
    final public function resolve(\stdClass $item)
    {
        return $item;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictParamRector\Fixture;

class SomeClass
{
    final public function resolve(\stdClass $item): \stdClass
    {
        return $item;
    }
}