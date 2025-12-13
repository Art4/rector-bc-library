<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector\Fixture;

class MultipleIntConstantReturn
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    final public function getStatus()
    {
        if ($this->active) {
            return self::STATUS_ACTIVE;
        }
        return self::STATUS_INACTIVE;
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector\Fixture;

class MultipleIntConstantReturn
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    final public function getStatus(): int
    {
        if ($this->active) {
            return self::STATUS_ACTIVE;
        }
        return self::STATUS_INACTIVE;
    }
}

?>
