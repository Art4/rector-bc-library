<?php

class SomeClass
{
    private function increaseNumber(int $number)
    {
        return ++$number;
    }

    public function decreaseNumber(int $number)
    {
        return --$number;
    }
}
-----
<?php

class SomeClass
{
    private function increaseNumber(int $number): int
    {
        return ++$number;
    }

    public function decreaseNumber(int $number)
    {
        return --$number;
    }
}
