<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\AddVoidReturnTypeWhereNoReturnRector\Fixture;

class SomeClass
{
    final public function getValues()
    {
        $value = 1000;
        return;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\AddVoidReturnTypeWhereNoReturnRector\Fixture;

class SomeClass
{
    final public function getValues(): void
    {
        $value = 1000;
        return;
    }
}