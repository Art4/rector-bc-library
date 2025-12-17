<?php

class SomeClass
{
    final public function getNumber()
    {
        return 200;
    }

    public function getAnotherNumber()
    {
        return 300;
    }
}
-----
<?php

class SomeClass
{
    final public function getNumber(): int
    {
        return 200;
    }

    public function getAnotherNumber()
    {
        return 300;
    }
}
