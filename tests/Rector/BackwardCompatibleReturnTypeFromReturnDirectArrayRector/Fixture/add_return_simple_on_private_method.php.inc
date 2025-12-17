<?php

class SomeClass
{
    private function getArray()
    {
        return [1, 2, 3];
    }
}
-----
<?php

class SomeClass
{
    private function getArray(): array
    {
        return [1, 2, 3];
    }
}
