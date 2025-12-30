<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector\Fixture;

class SomeClass
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    private function getStatus()
    {
        if ($this->active) {
            return self::STATUS_ACTIVE;
        }
        return self::STATUS_INACTIVE;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector\Fixture;

class SomeClass
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    private function getStatus(): int
    {
        if ($this->active) {
            return self::STATUS_ACTIVE;
        }
        return self::STATUS_INACTIVE;
    }
}
