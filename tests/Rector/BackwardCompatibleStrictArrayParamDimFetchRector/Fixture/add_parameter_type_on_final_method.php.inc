<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStrictArrayParamDimFetchRector\Fixture;

class SomeClass
{
    final public function resolve($item)
    {
        return $item['name'];
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStrictArrayParamDimFetchRector\Fixture;

class SomeClass
{
    final public function resolve(array $item)
    {
        return $item['name'];
    }
}
