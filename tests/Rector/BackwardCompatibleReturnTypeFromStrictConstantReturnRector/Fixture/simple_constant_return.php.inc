<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector\Fixture;

class SimpleConstantReturn
{
    public const NAME = 'name';

    public function getName()
    {
        return self::NAME;
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector\Fixture;

class SimpleConstantReturn
{
    public const NAME = 'name';

    public function getName(): string
    {
        return self::NAME;
    }
}

?>
