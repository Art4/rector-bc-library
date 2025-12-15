<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddVoidReturnTypeWhereNoReturnRector\Fixture;

final class SimpleVoidReturn
{
    public function getValues()
    {
        $value = 1000;
        return;
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddVoidReturnTypeWhereNoReturnRector\Fixture;

final class SimpleVoidReturn
{
    public function getValues(): void
    {
        $value = 1000;
        return;
    }
}

?>
