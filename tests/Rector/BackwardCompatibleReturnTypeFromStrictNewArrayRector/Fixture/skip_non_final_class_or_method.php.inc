<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictNewArrayRector\Fixture;

class SkipNonFinalClass
{
    public function run()
    {
        $values = [];

        return $values;
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictNewArrayRector\Fixture;

class SkipNonFinalClass
{
    public function run()
    {
        $values = [];

        return $values;
    }
}

?>
