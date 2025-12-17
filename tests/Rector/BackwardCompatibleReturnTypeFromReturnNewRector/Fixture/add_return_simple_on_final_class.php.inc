<?php

final class SomeClass
{
    public function create()
    {
        return new \stdClass();
    }
}
-----
<?php

final class SomeClass
{
    public function create(): \stdClass
    {
        return new \stdClass();
    }
}
