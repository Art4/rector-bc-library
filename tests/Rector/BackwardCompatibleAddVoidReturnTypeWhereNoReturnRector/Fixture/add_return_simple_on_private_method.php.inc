<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddVoidReturnTypeWhereNoReturnRector\Fixture;

class SomeClass
{
    private function getValues()
    {
        $value = 1000;
        return;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddVoidReturnTypeWhereNoReturnRector\Fixture;

class SomeClass
{
    private function getValues(): void
    {
        $value = 1000;
        return;
    }
}
