<?php

final class SomeClass
{
    public final function create()
    {
        return new \stdClass();
    }
}
-----
<?php

final class SomeClass
{
    public final function create(): \stdClass
    {
        return new \stdClass();
    }
}
