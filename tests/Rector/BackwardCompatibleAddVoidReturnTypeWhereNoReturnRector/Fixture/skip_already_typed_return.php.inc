<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddVoidReturnTypeWhereNoReturnRector\Fixture;

final class SkipAlreadyTypedReturn
{
    public function getValues(): void
    {
        $value = 1000;
        return;
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddVoidReturnTypeWhereNoReturnRector\Fixture;

final class SkipAlreadyTypedReturn
{
    public function getValues(): void
    {
        $value = 1000;
        return;
    }
}

?>
