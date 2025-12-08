<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector\Fixture;

class AlreadyTypedReturn
{
    public const MESSAGE = 'hello';

    public function getMessage(): string
    {
        return self::MESSAGE;
    }
}

?>
