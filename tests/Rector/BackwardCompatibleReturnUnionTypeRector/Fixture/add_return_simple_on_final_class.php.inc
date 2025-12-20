<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnUnionTypeRector\Fixture;

final class SomeClass
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
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnUnionTypeRector\Fixture;

final class SomeClass
{
    public function getData(): null|\DateTime|\stdClass
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
