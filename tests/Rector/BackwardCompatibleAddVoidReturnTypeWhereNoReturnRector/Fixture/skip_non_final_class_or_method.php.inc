<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddVoidReturnTypeWhereNoReturnRector\Fixture;

class SkipNonFinalClass
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

class SkipNonFinalClass
{
    public function getValues()
    {
        $value = 1000;
        return;
    }
}

?>
