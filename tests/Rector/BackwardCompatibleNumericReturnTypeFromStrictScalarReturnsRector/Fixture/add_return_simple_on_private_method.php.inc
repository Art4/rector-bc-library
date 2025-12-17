<?php

class SomeClass
{
    private function getNumber()
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
    private function getNumber(): int
    {
        return 200;
    }

    public function getAnotherNumber()
    {
        return 300;
    }
}
