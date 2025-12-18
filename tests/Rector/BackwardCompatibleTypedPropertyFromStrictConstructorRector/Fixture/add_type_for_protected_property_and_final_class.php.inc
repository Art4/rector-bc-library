<?php

final class SomeClass
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
-----
<?php

final class SomeClass
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
