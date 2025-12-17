<?php

class SomeClass
{
    private function getValue($number)
    {
        return $number ? 100 : 500;
    }
}
-----
<?php

class SomeClass
{
    private function getValue($number): int
    {
        return $number ? 100 : 500;
    }
}
