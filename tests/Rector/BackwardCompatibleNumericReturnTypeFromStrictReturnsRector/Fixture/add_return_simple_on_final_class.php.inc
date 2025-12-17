<?php

final class SomeClass
{
    public function increaseNumber(int $number)
    {
        return ++$number;
    }
}
-----
<?php

final class SomeClass
{
    public function increaseNumber(int $number): int
    {
        return ++$number;
    }
}
