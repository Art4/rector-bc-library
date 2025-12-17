<?php

final class SomeClass
{
    public function getArray()
    {
        return [1, 2, 3];
    }
}
-----
<?php

final class SomeClass
{
    public function getArray(): array
    {
        return [1, 2, 3];
    }
}
