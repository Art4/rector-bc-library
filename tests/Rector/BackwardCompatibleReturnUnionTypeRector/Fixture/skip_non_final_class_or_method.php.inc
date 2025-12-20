<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnUnionTypeRector\Fixture;

class SomeClass
{
    public function getData()
    {
        if (rand(0, 1)) {
            return null;
        }

        if (rand(0, 1)) {
            return new \DateTime('now');
        }

        return new \stdClass;
    }
}
