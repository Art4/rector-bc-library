<?php

final class SomeClass
{
    public function increaseNumber(int $number): mixed
    {
        return ++$number;
    }
}
-----
<?php

final class SomeClass
{
    public function increaseNumber(int $number): mixed
    {
        return ++$number;
    }
}
