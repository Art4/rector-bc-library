<?php

namespace Art4\RectorBcLibrary\Tests\BackwardCompatibleReturnNullableTypeRector;

class SomeClass
{
    final public function getData()
    {
        if (rand(0, 1)) {
            return null;
        }

        return 100;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\BackwardCompatibleReturnNullableTypeRector;

class SomeClass
{
    final public function getData(): ?int
    {
        if (rand(0, 1)) {
            return null;
        }

        return 100;
    }
}
