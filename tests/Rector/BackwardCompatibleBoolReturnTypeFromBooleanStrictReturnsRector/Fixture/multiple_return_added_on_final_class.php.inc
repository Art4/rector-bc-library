<?php

final class SomeClass
{
    public function check($a, $b)
    {
        if ($a > $b) {
            return $a > $b;
        }
        return $a < $b;
    }
}
-----
<?php

final class SomeClass
{
    public function check($a, $b): bool
    {
        if ($a > $b) {
            return $a > $b;
        }
        return $a < $b;
    }
}
