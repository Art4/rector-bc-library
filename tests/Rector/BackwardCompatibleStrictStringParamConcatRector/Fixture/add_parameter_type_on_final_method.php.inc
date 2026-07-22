<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStrictStringParamConcatRector\Fixture;

class SomeClass
{
    final public function resolve($item)
    {
        return $item . ' world';
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStrictStringParamConcatRector\Fixture;

class SomeClass
{
    final public function resolve(string $item)
    {
        return $item . ' world';
    }
}
