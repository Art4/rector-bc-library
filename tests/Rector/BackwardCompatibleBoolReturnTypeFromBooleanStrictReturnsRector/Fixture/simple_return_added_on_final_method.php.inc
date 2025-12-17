<?php

class SomeClass
{
    final public function isGreater($first, $second)
    {
        return $first > $second;
    }
}
-----
<?php

class SomeClass
{
    final public function isGreater($first, $second): bool
    {
        return $first > $second;
    }
}
