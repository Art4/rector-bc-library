<?php

class SomeClass
{
    final public function getArray()
    {
        return [1, 2, 3];
    }
}
-----
<?php

class SomeClass
{
    final public function getArray(): array
    {
        return [1, 2, 3];
    }
}
