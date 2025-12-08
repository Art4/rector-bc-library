<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector\Fixture;

final class SimpleConstantReturn
{
    public const NAME = 'name';

    public function getName(): string
    {
        return self::NAME;
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector\Fixture;

final class SimpleConstantReturn
{
    public const NAME = 'name';

    public function getName(): string
    {
        return self::NAME;
    }
}

?>
