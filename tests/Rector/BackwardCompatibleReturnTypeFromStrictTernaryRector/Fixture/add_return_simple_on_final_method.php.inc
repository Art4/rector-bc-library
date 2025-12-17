<?php

class SomeClass
{
    final public function getValue($number)
    {
        return $number ? 100 : 500;
    }
}
-----
<?php

class SomeClass
{
    final public function getValue($number): int
    {
        return $number ? 100 : 500;
    }
}
