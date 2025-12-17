<?php

class SomeClass
{
    private function isGreater($first, $second)
    {
        return $first > $second;
    }
}
-----
<?php

class SomeClass
{
    private function isGreater($first, $second): bool
    {
        return $first > $second;
    }
}
