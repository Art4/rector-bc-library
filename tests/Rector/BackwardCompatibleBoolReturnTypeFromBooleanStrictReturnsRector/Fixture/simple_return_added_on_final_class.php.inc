<?php

final class SomeClass
{
    public function isGreater($first, $second)
    {
        return $first > $second;
    }
}
-----
<?php

final class SomeClass
{
    public function isGreater($first, $second): bool
    {
        return $first > $second;
    }
}
