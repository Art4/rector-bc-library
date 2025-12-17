<?php

namespace Art4\RectorBcLibrary\Tests\BackwardCompatibleReturnTypeFromStrictTypedPropertyRector;

class SomeClass
{
    private int $age = 100;

    private function getAge()
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

    private function getAge(): int
    {
        return $this->age;
    }
}
