<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictConstantReturnRector\Fixture;

final class SomeClass
{
    public const NAME = 'name';

    public function getName(): string
    {
        return self::NAME;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictConstantReturnRector\Fixture;

final class SomeClass
{
    public const NAME = 'name';

    public function getName(): string
    {
        return self::NAME;
    }
}