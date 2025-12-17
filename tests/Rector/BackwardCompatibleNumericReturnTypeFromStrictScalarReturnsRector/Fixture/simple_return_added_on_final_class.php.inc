<?php

final class SomeClass
{
    public function getNumber()
    {
        return 200;
    }
}
-----
<?php

final class SomeClass
{
    public function getNumber(): int
    {
        return 200;
    }
}
