<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector\Fixture;

final class SomeClass
{
    public const MESSAGE = 'hello';

    public function getMessage(): mixed
    {
        return self::MESSAGE;
    }
}
