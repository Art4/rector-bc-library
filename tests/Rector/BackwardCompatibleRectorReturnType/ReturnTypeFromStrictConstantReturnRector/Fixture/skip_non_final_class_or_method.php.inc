<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictConstantReturnRector\Fixture;

class SomeClass
{
    public const NAME = 'name';

    public function getName()
    {
        return self::NAME;
    }
}