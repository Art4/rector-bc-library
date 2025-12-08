<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector\Fixture;

class NonFinalClass
{
    public const NAME = 'name';

    public function getName()
    {
        return self::NAME;
    }
}

?>
