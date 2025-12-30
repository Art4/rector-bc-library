<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector\Fixture;

class SomeClass
{
    public const NAME = 'name';

    final public function getName()
    {
        return self::NAME;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector\Fixture;

class SomeClass
{
    public const NAME = 'name';

    final public function getName(): string
    {
        return self::NAME;
    }
}
