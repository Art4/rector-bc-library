<?php

namespace Art4\RectorBcLibrary\Tests\BackwardCompatibleReturnTypeFromStrictTypedPropertyRector;

class SomeClass
{
    private int $age = 100;

    final public function getAge()
    {
        return $this->age;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\BackwardCompatibleReturnTypeFromStrictTypedPropertyRector;

class SomeClass
{
    private int $age = 100;

    final public function getAge(): int
    {
        return $this->age;
    }
}
