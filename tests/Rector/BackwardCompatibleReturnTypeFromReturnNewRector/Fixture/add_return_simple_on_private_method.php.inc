<?php

class SomeClass
{
    private function create()
    {
        return new \stdClass();
    }
}
-----
<?php

class SomeClass
{
    private function create(): \stdClass
    {
        return new \stdClass();
    }
}
