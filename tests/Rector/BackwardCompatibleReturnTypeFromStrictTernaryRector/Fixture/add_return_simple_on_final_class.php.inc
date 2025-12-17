<?php

final class SomeClass
{
    public function getValue($number)
    {
        return $number ? 100 : 500;
    }
}
-----
<?php

final class SomeClass
{
    public function getValue($number): int
    {
        return $number ? 100 : 500;
    }
}
