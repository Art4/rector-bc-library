<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibilityReturnTypeFromReturnNewRector\Fixture;

class SimpleReturnNew
{
    final public function create()
    {
        return new \stdClass();
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibilityReturnTypeFromReturnNewRector\Fixture;

class SimpleReturnNew
{
    final public function create(): \stdClass
    {
        return new \stdClass();
    }
}

?>
